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
        // Decode dynamic carousels JSON for blade
        $homepage->dynamic_carousels = $homepage->dynamic_carousels ? json_decode($homepage->dynamic_carousels, true) : [];
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

        $validated['dynamic_carousels'] = json_encode($dynamic);

        $homepage->fill($validated)->save();

        return back()->with('success', 'Homepage updated successfully!');
    }
    public function deleteDynamicCarousel(Request $request)
{
    try {
        $imagePath = $request->input('image_path');
        
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            // Delete the file from storage
            Storage::disk('public')->delete($imagePath);
            
            // Get current homepage data
            $homepage = Homepage::first();
            $dynamicCarousels = $homepage->dynamic_carousels ?? [];
            
            // Remove the carousel with matching image path
            $updatedCarousels = array_filter($dynamicCarousels, function($carousel) use ($imagePath) {
                return $carousel['image'] !== $imagePath;
            });
            
            // Re-index the array
            $updatedCarousels = array_values($updatedCarousels);
            
            // Update the database
            $homepage->dynamic_carousels = $updatedCarousels;
            $homepage->save();
            
            return response()->json(['success' => true, 'message' => 'Carousel deleted successfully']);
        }
        
        return response()->json(['success' => false, 'message' => 'Image not found'], 404);
        
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error deleting carousel: ' . $e->getMessage()], 500);
    }
}

}
