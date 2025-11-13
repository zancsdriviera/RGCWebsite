<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClubhouseContent;

class ClubHouseController extends Controller
{
    // Front-end view
    public function index()
    {
        // Fetch description and images from DB
        $description = ClubhouseContent::whereNotNull('description')->first();
        $images = ClubhouseContent::whereNotNull('image_path')->get();

        return view('clubhouse', compact('description', 'images'));
    }
}
