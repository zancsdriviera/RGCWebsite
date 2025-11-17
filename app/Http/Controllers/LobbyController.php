<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LobbyContent;

class MembersLoungeController extends Controller
{
    // Front-end view
    public function index()
    {
        // Fetch description and images from DB
        $description = LobbyContent::whereNotNull('description')->first();
        $images = LobbyContent::whereNotNull('image_path')->get();

        return view('membersLounge', compact('description', 'images'));
    }
}
