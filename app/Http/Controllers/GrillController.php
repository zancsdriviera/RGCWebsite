<?php

namespace App\Http\Controllers;

use App\Models\GrillContent;

class GrillController extends Controller
{
    public function index()
    {   
        $content = GrillContent::first();

        // SAFETY: prevent null crash
        $categories = collect($content->menu_categories ?? []);
        $menuItems  = collect($content->menu_items ?? []);

        $organizedMenu = [];

        foreach ($categories as $category) {
            $organizedMenu[$category['id']] = [
                'category' => $category,
                'items' => $menuItems
                    ->where('category_id', $category['id'])
                    ->values()
            ];
        }

        // Uncategorized fallback
        $uncategorized = $menuItems->whereNull('category_id')->values();
        if ($uncategorized->count()) {
            $organizedMenu['uncategorized'] = [
                'category' => [
                    'id' => null,
                    'name' => 'Other',
                    'description' => ''
                ],
                'items' => $uncategorized
            ];
        }

        // Process gallery images to ensure consistent format
        $gallery = $this->processGalleryImages($content->gallery_images ?? []);

        return view('grill', [
            'carousel'        => $content->carousel_images ?? [],
            'organizedMenu'   => $organizedMenu,
            'gallery'         => $gallery, // Processed gallery images
        ]);
    }

    /**
     * Process gallery images to ensure consistent format for front-end
     * Converts array format to simple path strings for backward compatibility
     */
    private function processGalleryImages($galleryImages)
    {
        $processed = [];
        
        foreach ($galleryImages as $image) {
            if (is_array($image)) {
                // New format: array with 'path' key
                $processed[] = $image['path'] ?? '';
            } else {
                // Old format: already a string path
                $processed[] = $image;
            }
        }
        
        return $processed;
    }
}