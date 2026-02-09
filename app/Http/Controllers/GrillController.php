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

        return view('grill', [
            'carousel'        => $content->carousel_images ?? [],
            'organizedMenu'   => $organizedMenu,
            'gallery'         => $content->gallery_images ?? [], // 4-grid
        ]);
    }
}
