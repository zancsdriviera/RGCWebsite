<?php

namespace App\Http\Controllers;

use App\Models\HomepageContent;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch first record or create an empty model (prevents undefined variable)
        $homepage = HomepageContent::first() ?? new HomepageContent();

        return view('home', compact('homepage'));
    }
}
