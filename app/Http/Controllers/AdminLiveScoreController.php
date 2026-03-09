<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveScore;
use App\Models\LiveScoreHeader;

class AdminLiveScoreController extends Controller
{
    public function index()
    {
        $headers = LiveScoreHeader::orderBy('created_at', 'desc')->get();
        $scores = LiveScore::orderByDesc('total_net')
            ->orderByDesc('total_grs')
            ->get();

        return view('admin.admin_live_scores', compact('headers', 'scores'));
    }

    public function activateHeader(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:255', // Changed from integer to string
            'status' => 'required|in:0,1'
        ]);

        // If activating this header, deactivate all others
        if ($request->status == 1) {
            LiveScoreHeader::where('status', 1)->update(['status' => 0]);
        }

        $header = LiveScoreHeader::create([
            'year' => $request->year,
            'status' => $request->status,
        ]);

        return response()->json(['success' => true, 'header' => $header]);
    }

    public function editHeader(Request $request, $id)
    {
        $request->validate([
            'year' => 'required|string|max:255', // Changed from integer to string
            'status' => 'required|in:0,1'
        ]);

        $header = LiveScoreHeader::findOrFail($id);

        // If activating this header, deactivate all others
        if ($request->status == 1) {
            LiveScoreHeader::where('status', 1)->where('id', '!=', $id)->update(['status' => 0]);
        }

        $header->update([
            'year' => $request->year,
            'status' => $request->status,
        ]);

        return response()->json(['success' => true, 'header' => $header]);
    }

    public function deleteHeader($id)
    {
        $header = LiveScoreHeader::findOrFail($id);
        $header->delete();
        return response()->json(['success' => true]);
    }

    public function deleteSelectedHeaders(Request $request)
    {
        if ($request->has('ids') && is_array($request->ids)) {
            LiveScoreHeader::whereIn('id', $request->ids)->delete();
            return response()->json(['success' => true, 'message' => 'Headers deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'No headers selected'], 400);
    }

    public function getHeaders()
    {
        $headers = LiveScoreHeader::orderBy('created_at', 'desc')->get();
        return response()->json($headers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'team' => 'required|string',
            'couples_grs' => 'required|numeric',
            'langer_grs' => 'required|numeric',
            'couples_net' => 'required|numeric',
            'langer_net' => 'required|numeric',
            'class' => 'required|string'
        ]);

        $score = LiveScore::create($request->all());
        
        // Get updated scores with ranking
        $scores = LiveScore::orderByDesc('total_net')
            ->orderByDesc('total_grs')
            ->get();

        return response()->json(['success' => true, 'score' => $score, 'scores' => $scores]);
    }

    public function getScore($id)
    {
        $score = LiveScore::findOrFail($id);
        return response()->json($score);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'team' => 'required|string',
            'couples_grs' => 'required|numeric',
            'langer_grs' => 'required|numeric',
            'couples_net' => 'required|numeric',
            'langer_net' => 'required|numeric',
            'class' => 'required|string'
        ]);

        $score = LiveScore::findOrFail($id);
        $score->update($request->all());
        
        // Get updated scores with ranking
        $scores = LiveScore::orderByDesc('total_net')
            ->orderByDesc('total_grs')
            ->get();

        return response()->json(['success' => true, 'score' => $score, 'scores' => $scores]);
    }

    public function destroy($id)
    {
        $score = LiveScore::findOrFail($id);
        $score->delete();
        
        // Get updated scores with ranking
        $scores = LiveScore::orderByDesc('total_net')
            ->orderByDesc('total_grs')
            ->get();

        return response()->json(['success' => true, 'scores' => $scores]);
    }

    public function deleteSelected(Request $request)
    {
        if ($request->has('ids') && is_array($request->ids)) {
            LiveScore::whereIn('id', $request->ids)->delete();
            
            // Get updated scores with ranking
            $scores = LiveScore::orderByDesc('total_net')
                ->orderByDesc('total_grs')
                ->get();

            return response()->json(['success' => true, 'scores' => $scores]);
        }
        return response()->json(['success' => false, 'message' => 'No scores selected'], 400);
    }
}