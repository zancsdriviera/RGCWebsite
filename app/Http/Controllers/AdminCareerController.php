<?php

namespace App\Http\Controllers;

use App\Models\CareerContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCareerController extends Controller
{
    /**
     * Display the uploaded career images.
     */
    public function index()
    {
        $careers = CareerContent::latest()->get();
        return view('admin.admin_careers', compact('careers'));
    }

    /**
     * Store a new career image.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'career_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('career_image')) {
            $path = $request->file('career_image')->store('careers', 'public');
            CareerContent::create(['career_image' => $path]);
        }

        return back()->with('success', 'Career image added successfully!');
    }

    /**
     * Update an existing career image.
     */
    public function update(Request $request, CareerContent $career)
    {
        $validated = $request->validate([
            'career_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('career_image')) {
            // delete old image if exists
            if ($career->career_image && Storage::disk('public')->exists($career->career_image)) {
                Storage::disk('public')->delete($career->career_image);
            }

            $path = $request->file('career_image')->store('careers', 'public');
            $career->update(['career_image' => $path]);
        }

        return back()->with('success', 'Career image updated successfully!');
    }

    /**
     * Delete the specified career image.
     */
    public function destroy(CareerContent $career)
    {
        if ($career->career_image && Storage::disk('public')->exists($career->career_image)) {
            Storage::disk('public')->delete($career->career_image);
        }

        $career->delete();
        return back()->with('success', 'Career image deleted successfully!');
    }
}
