<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProshopContent;

class ProshopController extends Controller
{
    // Front-end view
    public function index()
    {
        // Fetch description and images from DB
        $description = ProshopContent::whereNotNull('description')->first();
        $images = ProshopContent::whereNotNull('image_path')->get();

        return view('proshop', compact('description', 'images'));
    }
}
