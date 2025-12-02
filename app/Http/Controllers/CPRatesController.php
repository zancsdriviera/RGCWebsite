<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gpeak;

class CPRatesController extends Controller
{
    public function index()
    {
        // Separate Gpeaks by type
        $firstGpeaks  = Gpeak::where('type', 'first')->get();
        $secondGpeaks = Gpeak::where('type', 'second')->get();
        $thirdGpeaks  = Gpeak::where('type', 'third')->get();

        // Return the Peak Season rates view
        return view('rates2', compact('firstGpeaks', 'secondGpeaks', 'thirdGpeaks'));
    }
}
