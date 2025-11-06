<?php

namespace App\Http\Controllers; // ✅ Add this

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // ✅ Import the base Controller

class HoleInOneController extends Controller
{
    public function index()
    {
        return view('holeinone');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'hole_number' => 'required|integer|min:1|max:18',
            'date' => 'required|date',
        ]);

        try {
            DB::table('hole_in_one')->insert([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'hole_number' => $validated['hole_number'],
                'date' => $validated['date'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return back()->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add record: ' . $e->getMessage());
        }
    }
}
