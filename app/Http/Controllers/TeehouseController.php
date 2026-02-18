<?php

namespace App\Http\Controllers;

use App\Models\TeehouseContent;

class TeehouseController extends Controller
{
    public function index()
    {
        $content = TeehouseContent::first();

        $teepav = $content->teepav_images ?? [];
        $lf9 = $content->lf9_images ?? [];
        $hwl = $content->hwl_images ?? [];
        $cf9 = $content->cf9_images ?? [];
        $hwc = $content->hwc_images ?? [];

        return view('teehouse', compact('teepav','lf9','hwl','cf9','hwc'));
    }
}
