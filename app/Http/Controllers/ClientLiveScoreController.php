<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveScore;
use App\Models\LiveScoreHeader;

class ClientLiveScoreController extends Controller
{
    public function index()
    {
        $header = LiveScoreHeader::where('status', 1)->first();
        return view('live_scores', compact('header'));
    }

    public function getData()
    {
        $header = LiveScoreHeader::where('status', 1)->first();
        $scores = LiveScore::orderByDesc('total_net')
            ->orderByDesc('total_grs')
            ->get();

        return response()->json([
            'header' => $header,
            'scores' => $scores
        ]);
    }
}