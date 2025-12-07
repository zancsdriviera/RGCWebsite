<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GrillContent;

class GrillController extends Controller
{
    public function index()
    {
        $content = GrillContent::first();
        // make convenient accessors for blade
        $carousel = $content->carousel_images ?? [];
        $menu = $content->menu_items ?? [];
        return view('grill', [
            'carousel' => $carousel,
            'menu' => $menu,
        ]);
    }
}
