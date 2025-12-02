<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Glean;

class CLRatesController extends Controller
{
    public function index()
    {
        // Separate Gleans by type
        $firstGleans  = Glean::where('type', 'first')->get();
        $secondGleans = Glean::where('type', 'second')->get();
        $thirdGleans  = Glean::where('type', 'third')->get();

        return view('rates', compact('firstGleans', 'secondGleans', 'thirdGleans'));
    }
}
