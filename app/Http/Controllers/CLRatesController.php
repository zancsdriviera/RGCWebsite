<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Glean;

class CLRatesController extends Controller
{
    public function index()
    {
        // Separate Gleans by type (excluding settings)
        $firstGleans  = Glean::where('type', 'first')->get();
        $secondGleans = Glean::where('type', 'second')->get();
        $thirdGleans  = Glean::where('type', 'third')->get();
        
        // Get dynamic caption
        $leanSeasonCaption = Glean::getSetting('lean_season_caption', 'LEAN SEASON (APRIL - OCTOBER 2025)');

        return view('rates', compact('firstGleans', 'secondGleans', 'thirdGleans', 'leanSeasonCaption'));
    }
}