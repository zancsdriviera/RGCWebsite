<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementContent;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = AnnouncementContent::getPublished();
        return view('announcement', compact('announcements'));
    }

    public function show($slug)
    {
        $announcement = AnnouncementContent::getBySlug($slug);
        return view('announcement', compact('announcement'));
    }
}