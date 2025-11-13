<?php

namespace App\Http\Controllers;

use App\Models\TournamentRatesContent;
use Illuminate\Http\Request;

class AdminTournamentRatesController extends Controller
{
    public function index()
    {
        $tournamentRates = TournamentRatesContent::all();
        return view('admin.admin_tournament_rates', compact('tournamentRates'));
    }

    public function update(Request $request, TournamentRatesContent $tournament_rate)
    {
        $validated = $request->validate([
            'season' => 'required|string|max:255',
            'green_fee' => 'nullable|string',
            'scoring_fee' => 'nullable|numeric',
            'caddie_fee' => 'nullable|numeric',
            'golf_cart_fee' => 'nullable|numeric',
            'hole_in_one_fund' => 'nullable|numeric',
            'sports_dev_fund' => 'nullable|numeric',
            'environmental_fund' => 'nullable|numeric',
            'food_beverage' => 'nullable|string',
        ]);

        // Normalizer helper (keeps en-dash, ensures PHP prefix on lines starting with digits)
        $normalizeLines = function (?string $text) {
            if ($text === null) return null;
            $lines = preg_split("/\r?\n/", trim($text));
            $lines = array_map(function($line) {
                $line = trim($line);
                if ($line === '') return null;
                // normalize dash variants to en-dash with spaces around
                $line = preg_replace('/\s*[-–—]\s*/u', ' – ', $line);
                // if line starts with digit, add PHP prefix (avoid double prefix)
                if (preg_match('/^\d/', $line) && !preg_match('/^(PHP|₱)/i', $line)) {
                    $line = 'PHP ' . $line;
                }
                // if starts with PHP but missing space after PHP, ensure a space
                $line = preg_replace('/^PHP(?=\d)/i', 'PHP ', $line);
                return $line;
            }, $lines);
            $lines = array_filter($lines, fn($l) => $l !== null && $l !== '');
            return implode("\n", $lines);
        };

        $data = [];

        // preserve season
        $data['season'] = $validated['season'];

        // normalize text fields (keep newlines)
        $data['green_fee'] = $normalizeLines($validated['green_fee'] ?? $tournament_rate->green_fee);
        $data['food_beverage'] = $normalizeLines($validated['food_beverage'] ?? $tournament_rate->food_beverage);

        // numeric fields: keep numeric, store as decimals (or null)
        $data['scoring_fee'] = isset($validated['scoring_fee']) ? (float)$validated['scoring_fee'] : $tournament_rate->scoring_fee;
        $data['caddie_fee'] = isset($validated['caddie_fee']) ? (float)$validated['caddie_fee'] : $tournament_rate->caddie_fee;
        $data['golf_cart_fee'] = isset($validated['golf_cart_fee']) ? (float)$validated['golf_cart_fee'] : $tournament_rate->golf_cart_fee;
        $data['hole_in_one_fund'] = isset($validated['hole_in_one_fund']) ? (float)$validated['hole_in_one_fund'] : $tournament_rate->hole_in_one_fund;
        $data['sports_dev_fund'] = isset($validated['sports_dev_fund']) ? (float)$validated['sports_dev_fund'] : $tournament_rate->sports_dev_fund;
        $data['environmental_fund'] = isset($validated['environmental_fund']) ? (float)$validated['environmental_fund'] : $tournament_rate->environmental_fund;

        $tournament_rate->update($data);

        return redirect()->route('admin.tournament_rates.index')->with('success', 'Tournament rates updated successfully!');
    }

}
