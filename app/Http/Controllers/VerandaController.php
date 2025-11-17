<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerandaContent;

class VerandaController extends Controller
{
    // Front-end view
    public function index()
    {
        // Fetch description and images from DB
        $description = VerandaContent::whereNotNull('description')->first();
        $images = VerandaContent::whereNotNull('image_path')->get();

        return view('veranda', compact('description', 'images'));
    }
}
