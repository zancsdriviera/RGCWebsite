<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHoleInOneController extends Controller
{
    // GET /admin/hole-in-one
    public function index()
    {
        // fetch records from the single table 'hole_in_one_contents' and split by type
        $couples = DB::table('hole_in_one_contents')
            ->where('type', 'couples')
            ->orderByDesc('date')
            ->get();

        $langer = DB::table('hole_in_one_contents')
            ->where('type', 'langer')
            ->orderByDesc('date')
            ->get();

        return view('admin.admin_holeinone', compact('couples', 'langer'));
    }

    // POST /admin/hole-in-one/{type}
    public function store(Request $request, $type)
    {
        // only allow the two expected types
        if (!in_array($type, ['couples', 'langer'])) {
            abort(404);
        }

        $request->validate([
            'first_name'  => 'required|string|max:191',
            'last_name'   => 'required|string|max:191',
            'hole_number' => 'required|integer|min:1|max:18',
            'date'        => 'required|date',
        ]);

        DB::table('hole_in_one_contents')->insert([
            'type'        => $type,
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'hole_number' => $request->hole_number,
            'date'        => $request->date,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return back()->with('success', 'Record added.');
    }
    

    // DELETE /admin/hole-in-one/{type}/{id}
    public function destroy($type, $id)
    {
        if (!in_array($type, ['couples', 'langer'])) {
            abort(404);
        }

        // ensure record belongs to the expected type before deleting
        $deleted = DB::table('hole_in_one_contents')
            ->where('id', $id)
            ->where('type', $type)
            ->delete();

        if ($deleted) {
            return back()->with('success', 'Record deleted.');
        }

        return back()->with('error', 'Record not found.');
    }

    public function update(Request $request, $type, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'hole_number' => 'required|integer|min:1|max:18',
            'date' => 'required|date',
        ]);

        DB::table('hole_in_one_contents')
            ->where('id', $id)
            ->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'hole_number' => $validated['hole_number'],
                'date' => $validated['date'],
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Record updated successfully!');
    }

}
