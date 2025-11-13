<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrivingrangeContent;

class DrivingRangeController extends Controller
{
    // Front-end view
    public function index()
    {
        // Fetch description and images from DB
        $description = DrivingrangeContent::whereNotNull('description')->first();
        $images = DrivingrangeContent::whereNotNull('image_path')->get();

        return view('drivingrange', compact('description', 'images'));
    }
}
