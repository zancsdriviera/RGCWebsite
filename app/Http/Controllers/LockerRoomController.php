<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LockerRoomContent;

class LockerRoomController extends Controller
{
    // Front-end view
    public function index()
    {
        // Fetch description and images from DB
        $description = LockerRoomContent::whereNotNull('description')->first();
        $images = LockerRoomContent::whereNotNull('image_path')->get();

        return view('locker', compact('description', 'images'));
    }
}
