<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomepageContent;

class AdminHomepageController extends Controller
{
    /**
     * Show CMS page with existing homepage content or empty placeholders.
     */
    public function index()
    {
        $homepage = HomepageContent::first() ?? new HomepageContent();
        
        // Ensure dynamic_carousels is an array (cast should handle this)
        if (!is_array($homepage->dynamic_carousels)) {
            $homepage->dynamic_carousels = [];
        }
        
        return view('admin.admin_homepage', compact('homepage'));
    }

    /**
     * Update or create homepage content while preserving existing images.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'headline' => 'nullable|string|max:255',
            'subheadline' => 'nullable|string',
            'carousel1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20240',
            'carousel2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20240',
            'carousel3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20240',
            'carousel4' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20240',
            'carousel5' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20240',
            'carousel1Caption' => 'nullable|string',
            'carousel2Caption' => 'nullable|string',
            'carousel3Caption' => 'nullable|string',
            'carousel4Caption' => 'nullable|string',
            'carousel5Caption' => 'nullable|string',
            'card1_title' => 'nullable|string|max:255',
            'card2_title' => 'nullable|string|max:255',
            'card3_title' => 'nullable|string|max:255',
            'card1_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'card2_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'card3_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'dynamicCarousels' => 'nullable|array',
            'dynamicCarousels.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20240',
            'dynamicCarousels.*.caption' => 'nullable|string',
            'dynamicCarousels.*.existing_image' => 'nullable|string',
        ]);

        $homepage = HomepageContent::firstOrNew(['id' => 1]);

        // Handle static images (carousel1–5 & cards)
        $imageFields = [
            'carousel1', 'carousel2', 'carousel3', 'carousel4', 'carousel5',
            'card1_image', 'card2_image', 'card3_image'
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('homepage', 'public');
            } else {
                $validated[$field] = $homepage->{$field};
            }
        }

        // Handle dynamic carousels
        $dynamic = [];
        if (!empty($request->dynamicCarousels)) {
            foreach ($request->dynamicCarousels as $key => $item) {
                $imgPath = $item['existing_image'] ?? null;

                // If user uploaded new file, replace
                if (isset($item['image']) && $request->hasFile("dynamicCarousels.$key.image")) {
                    $imgPath = $request->file("dynamicCarousels.$key.image")->store('homepage', 'public');
                }

                // Skip completely removed items (no existing image and no new upload)
                if (!$imgPath) continue;

                $dynamic[] = [
                    'id' => $key, // preserve unique key
                    'image' => $imgPath,
                    'caption' => $item['caption'] ?? '',
                ];
            }
        }

        $validated['dynamic_carousels'] = $dynamic; // Already an array, no json_encode needed

        $homepage->fill($validated)->save();

        return back()->with('success', 'Homepage updated successfully!');
    }

    /**
     * AJAX: Save dynamic carousel
     */
    public function saveDynamicCarousel(Request $request)
    {
        try {
            $request->validate([
                'caption' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20240',
                'existing_image' => 'nullable|string',
                'mode' => 'required|in:create,update',
                'id' => 'nullable|integer'
            ]);

            $homepage = HomepageContent::firstOrNew([]);
            
            // Get dynamic carousels (already array due to cast)
            $dynamic = $homepage->dynamic_carousels ?? [];
            
            // Ensure it's an array
            if (!is_array($dynamic)) {
                $dynamic = [];
            }

            $imgPath = $request->existing_image;

            if ($request->hasFile('image')) {
                $imgPath = $request->file('image')->store('homepage', 'public');
            }

            if ($request->mode === 'create') {
                // Generate new ID
                $maxId = 0;
                foreach ($dynamic as $item) {
                    $itemId = is_array($item) ? ($item['id'] ?? 0) : 0;
                    if ($itemId > $maxId) {
                        $maxId = $itemId;
                    }
                }
                $id = $maxId + 1;
                
                $dynamic[] = [
                    'id' => $id,
                    'image' => $imgPath,
                    'caption' => $request->caption
                ];
            } else {
                // Update existing
                $id = (int) $request->id;
                $updated = false;
                
                foreach ($dynamic as &$item) {
                    if (is_array($item) && ($item['id'] ?? 0) == $id) {
                        $item['image'] = $imgPath ?: ($item['image'] ?? '');
                        $item['caption'] = $request->caption;
                        $updated = true;
                        break;
                    }
                }
                
                if (!$updated) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Carousel not found for update'
                    ]);
                }
            }

            $homepage->dynamic_carousels = $dynamic;
            $homepage->save();

            return response()->json([
                'success' => true,
                'message' => 'Carousel saved successfully.',
                'data' => [
                    'id' => $id,
                    'image' => $imgPath
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * AJAX: Remove dynamic carousel
     */
    public function removeDynamicCarousel(Request $request)
    {
        try {
            $request->validate(['id' => 'required']);
            
            $homepage = HomepageContent::first();
            
            if (!$homepage) {
                return response()->json(['success' => false, 'message' => 'No homepage found']);
            }
            
            // Get dynamic carousels (already array due to cast)
            $dynamic = $homepage->dynamic_carousels ?? [];
            
            // Ensure it's an array
            if (!is_array($dynamic)) {
                $dynamic = [];
            }
            
            $id = (int) $request->id;
            
            // Remove matching ID
            $newDynamic = [];
            foreach ($dynamic as $item) {
                if (is_array($item) && ($item['id'] ?? 0) != $id) {
                    $newDynamic[] = $item;
                }
            }
            
            // Save back to database
            $homepage->dynamic_carousels = $newDynamic;
            $homepage->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Carousel removed successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}