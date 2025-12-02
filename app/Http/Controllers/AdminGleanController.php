<?php

namespace App\Http\Controllers;

use App\Models\Glean;
use Illuminate\Http\Request;

class AdminGleanController extends Controller
{
    // Show all Golf Rates
    public function index()
    {
        $gleans = Glean::all();
        return view('admin.admin_glean', compact('gleans'));
    }

    // Store new Golf Rate
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:first,second,third',
        ]);

        $data = [
            'type' => $request->type,
            'title1' => $request->title1,
            'total1' => $request->total1,
            'body1' => $request->body1,
            'price1' => $request->price1,
            'sched1' => $request->sched1,
            'title2' => $request->title2,
            'paragraph2' => $request->paragraph2,
            'total2' => $request->total2,
            'body2' => $request->body2,
            'price2' => $request->price2,
            'sched2' => $request->sched2,
            'title3' => $request->title3,
            'paragraph3' => $request->paragraph3,
            'body3' => $request->body3,
            'price3' => $request->price3,
        ];

        Glean::create($data);

        return redirect()->back()->with('success', 'Golf Rates created successfully!');
    }

    // Update existing Golf Rate
    public function update(Request $request, $id)
    {
        $glean = Glean::findOrFail($id);

        $data = [
            'type' => $request->type,
            'title1' => $request->title1,
            'total1' => $request->total1,
            'body1' => $request->body1,
            'price1' => $request->price1,
            'sched1' => $request->sched1,
            'title2' => $request->title2,
            'paragraph2' => $request->paragraph2,
            'total2' => $request->total2,
            'body2' => $request->body2,
            'price2' => $request->price2,
            'sched2' => $request->sched2,
            'title3' => $request->title3,
            'paragraph3' => $request->paragraph3,
            'body3' => $request->body3,
            'price3' => $request->price3,
        ];

        $glean->update($data);

        return redirect()->back()->with('success', 'Golf Rates updated successfully!');
    }

    // Delete Golf Rate
    public function destroy($id)
    {
        Glean::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Golf Rates deleted successfully!');
    }
}
