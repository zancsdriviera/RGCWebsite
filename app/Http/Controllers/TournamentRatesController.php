<?php

namespace App\Http\Controllers;

use App\Models\TournamentRates;
use Illuminate\Http\Request;

class TournamentRatesController extends Controller
{
    public function index()
    {
        $tournamentRates = TournamentRates::all()->map(function ($rate) {
            // Preserve spacing and dashes visually
            $rate->green_fee = nl2br(e($rate->green_fee));
            $rate->food_beverage = nl2br(e($rate->food_beverage));
            return $rate;
        });

        return view('tournament_rates', compact('tournamentRates'));
    }

}
