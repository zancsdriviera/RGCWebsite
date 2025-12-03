<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeehouseContent;

class TeehouseController extends Controller
{
    public function index()
    {
        $content = TeehouseContent::first();
        // ensure arrays exist
        $lf9 = $content->lf9_images ?? [];
        $hwl = $content->hwl_images ?? [];
        $cf9 = $content->cf9_images ?? [];
        $hwc = $content->hwc_images ?? [];

        return view('teehouse', compact('lf9', 'hwl', 'cf9', 'hwc'));
    }
}
