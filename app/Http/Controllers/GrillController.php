<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GrillContent;

class GrillController extends Controller
{
    public function index()
{
    $content = GrillContent::first();
    
    // Organize menu items by category
    $categories = collect($content->menu_categories ?? []);
    $menuItems = collect($content->menu_items ?? []);
    
    // Group menu items by category
    $organizedMenu = [];
    foreach ($categories as $category) {
        $organizedMenu[$category['id']] = [
            'category' => $category,
            'items' => $menuItems->where('category_id', $category['id'])->values()
        ];
    }
    
    // Also include uncategorized items
    $uncategorized = $menuItems->whereNull('category_id')->values();
    if ($uncategorized->count() > 0) {
        $organizedMenu['uncategorized'] = [
            'category' => ['id' => null, 'name' => 'Other', 'description' => ''],
            'items' => $uncategorized
        ];
    }
    
    return view('grill', [
        'carousel' => $content->carousel_images ?? [],
        'organizedMenu' => $organizedMenu,
    ]);
}
}