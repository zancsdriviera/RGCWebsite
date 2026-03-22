<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gpeak;

class CPRatesController extends Controller
{
    public function index()
    {
        // Separate Gpeaks by type (excluding settings)
        $firstGpeaks  = Gpeak::where('type', 'first')->get();
        $secondGpeaks = Gpeak::where('type', 'second')->get();
        $thirdGpeaks  = Gpeak::where('type', 'third')->get();
        
        // Get dynamic caption from Gpeak model
        $peakSeasonCaption = Gpeak::getSetting('peak_season_caption', 'PEAK SEASON (NOVEMBER - MARCH 2026)');

        return view('rates2', compact('firstGpeaks', 'secondGpeaks', 'thirdGpeaks', 'peakSeasonCaption'));
    }
}