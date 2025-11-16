<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembersLoungeContent;

class MembersLoungeController extends Controller
{
    // Front-end view
    public function index()
    {
        // Fetch description and images from DB
        $description = MembersLoungeContent::whereNotNull('description')->first();
        $images = MembersLoungeContent::whereNotNull('image_path')->get();

        return view('membersLounge', compact('description', 'images'));
    }
}
