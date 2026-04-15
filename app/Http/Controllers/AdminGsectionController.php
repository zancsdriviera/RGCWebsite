<?php

namespace App\Http\Controllers;

use App\Models\Gsection;
use Illuminate\Http\Request;

class AdminGsectionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required|integer',
        ]);

        Gsection::create($request->only('order_number'));
        return redirect()->back()->with('success', 'Section added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'order_number' => 'required|integer',
        ]);

        Gsection::findOrFail($id)->update($request->only('order_number'));
        return redirect()->back()->with('success', 'Section updated successfully!');
    }

    public function destroy($id)
    {
        Gsection::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Section and its contents deleted successfully!');
    }
}