<?php

namespace App\Http\Controllers;

use App\Models\AboutUsContent;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUsContent::latest()->first(); // always fetch the latest entry

        // fallback if table is empty
        if (!$aboutUs) {
            $aboutUs = new AboutUsContent([
                'mission_title' => '',
                'mission_text' => '',
                'mission_image' => null,
                'vision_title' => '',
                'vision_text' => '',
                'vision_image' => null,
                'boards' => [],
                'board_year' => '',
                'facilities_caption' => '',
                'facilities_bullets' => [],
                'facilities_image' => null,
                'values' => [],
            ]);
        }

        return view('about_us', compact('aboutUs'));
    }
}
