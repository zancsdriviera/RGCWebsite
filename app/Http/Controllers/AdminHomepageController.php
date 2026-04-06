<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomepageContent;

class AdminHomepageController extends Controller
{
    public function index()
    {
        $homepage = HomepageContent::first() ?? new HomepageContent();

        if (!is_array($homepage->dynamic_carousels)) {
            $homepage->dynamic_carousels = [];
        }

        return view('admin.admin_homepage', compact('homepage'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'headline'          => 'nullable|string|max:255',
            'subheadline'       => 'nullable|string',
            'carousel1'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'carousel2'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'carousel3'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'carousel4'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'carousel5'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'carousel1Caption'  => 'nullable|string',
            'carousel2Caption'  => 'nullable|string',
            'carousel3Caption'  => 'nullable|string',
            'carousel4Caption'  => 'nullable|string',
            'carousel5Caption'  => 'nullable|string',
            'card1_title'       => 'nullable|string|max:255',
            'card2_title'       => 'nullable|string|max:255',
            'card3_title'       => 'nullable|string|max:255',
            'card1_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'card2_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'card3_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $homepage = HomepageContent::firstOrNew(['id' => 1]);

        // Handle static images
        $imageFields = [
            'carousel1', 'carousel2', 'carousel3', 'carousel4', 'carousel5',
            'card1_image', 'card2_image', 'card3_image',
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('homepage', 'public');
            } else {
                $validated[$field] = $homepage->{$field};
            }
        }

        // ── Preserve dynamic carousels exactly as they are ──────────────────
        // Dynamic carousels are managed exclusively via AJAX (saveDynamicCarousel /
        // removeDynamicCarousel). The main Save Changes form must never touch them.
        $validated['dynamic_carousels'] = $homepage->dynamic_carousels ?? [];

        $homepage->fill($validated)->save();

        return back()->with('success', 'Homepage updated successfully!');
    }

    /**
     * AJAX: Save (create or update) a dynamic carousel item.
     */
    public function saveDynamicCarousel(Request $request)
    {
        try {
            $request->validate([
                'image'          => 'nullable|mimes:jpg,jpeg,png,webp,mp4,mov,avi,webm|max:307200',
                'existing_image' => 'nullable|string',
                'caption'        => 'nullable|string|max:255',   // no longer required
                'mode'           => 'required|in:create,update',
                'id'             => 'nullable|integer',
            ]);

            $homepage = HomepageContent::firstOrNew([]);

            $dynamic = $homepage->dynamic_carousels ?? [];
            if (!is_array($dynamic)) {
                $dynamic = [];
            }

            $imgPath = $request->existing_image;

            if ($request->hasFile('image')) {
                $file     = $request->file('image');
                $mimeType = $file->getMimeType();

                // Store videos in homepage/videos sub-folder for clarity
                if (str_starts_with($mimeType, 'video/')) {
                    $imgPath = $file->store('homepage/videos', 'public');
                } else {
                    $imgPath = $file->store('homepage', 'public');
                }
            }

            if ($request->mode === 'create') {
                $maxId = 0;
                foreach ($dynamic as $item) {
                    $itemId = is_array($item) ? ($item['id'] ?? 0) : 0;
                    if ($itemId > $maxId) $maxId = $itemId;
                }
                $id = $maxId + 1;

                $dynamic[] = [
                    'id'      => $id,
                    'image'   => $imgPath,
                    'caption' => $request->caption ?? '',
                ];
            } else {
                $id      = (int) $request->id;
                $updated = false;

                foreach ($dynamic as &$item) {
                    if (is_array($item) && ($item['id'] ?? 0) == $id) {
                        $item['image']   = $imgPath ?: ($item['image'] ?? '');
                        $item['caption'] = $request->caption ?? '';
                        $updated         = true;
                        break;
                    }
                }

                if (!$updated) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Carousel not found for update',
                    ]);
                }
            }

            $homepage->dynamic_carousels = $dynamic;
            $homepage->save();

            // Detect whether the saved file is a video so the blade can render it correctly
            $isVideo = false;
            if ($imgPath) {
                $ext     = strtolower(pathinfo($imgPath, PATHINFO_EXTENSION));
                $isVideo = in_array($ext, ['mp4', 'mov', 'avi', 'webm']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Carousel saved successfully.',
                'data'    => [
                    'id'      => $id,
                    'image'   => $imgPath,
                    'is_video'=> $isVideo,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * AJAX: Remove a dynamic carousel item.
     */
    public function removeDynamicCarousel(Request $request)
    {
        try {
            $request->validate(['id' => 'required']);

            $homepage = HomepageContent::first();

            if (!$homepage) {
                return response()->json(['success' => false, 'message' => 'No homepage found']);
            }

            $dynamic = $homepage->dynamic_carousels ?? [];
            if (!is_array($dynamic)) {
                $dynamic = [];
            }

            $id         = (int) $request->id;
            $newDynamic = [];

            foreach ($dynamic as $item) {
                if (is_array($item) && ($item['id'] ?? 0) != $id) {
                    $newDynamic[] = $item;
                }
            }

            $homepage->dynamic_carousels = $newDynamic;
            $homepage->save();

            return response()->json([
                'success' => true,
                'message' => 'Carousel removed successfully',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}