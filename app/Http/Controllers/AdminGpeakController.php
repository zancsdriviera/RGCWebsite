<?php

namespace App\Http\Controllers;

use App\Models\Gpeak;
use Illuminate\Http\Request;

class AdminGpeakController extends Controller
{
    public function index()
    {
        // Get only content types (not settings)
        $gpeaks = Gpeak::where('type', '!=', 'setting')->get();
        $peakSeasonCaption = Gpeak::getSetting('peak_season_caption', 'PEAK SEASON (NOVEMBER - MARCH 2026)');
        
        return view('admin.admin_gpeak', compact('gpeaks', 'peakSeasonCaption'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:first,second,third',
        ]);

        Gpeak::create($request->all());
        return redirect()->back()->with('success', 'Golf Rate added successfully!');
    }

    public function update(Request $request, $id)
    {
        $gpeak = Gpeak::findOrFail($id);
        $gpeak->update($request->all());
        return redirect()->back()->with('success', 'Golf Rate updated successfully!');
    }

    public function destroy($id)
    {
        Gpeak::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Golf Rate deleted successfully!');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'peak_season_caption' => 'required|string|max:255',
        ]);

        Gpeak::setSetting('peak_season_caption', $request->peak_season_caption);

        return redirect()->back()->with('success', 'Peak season caption updated successfully!');
    }
}