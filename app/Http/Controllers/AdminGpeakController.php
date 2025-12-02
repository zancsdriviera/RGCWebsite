<?php

namespace App\Http\Controllers;

use App\Models\Gpeak;
use Illuminate\Http\Request;

class AdminGpeakController extends Controller
{
    public function index()
    {
        $gpeaks = Gpeak::all();
        return view('admin.admin_gpeak', compact('gpeaks'));
    }

    public function store(Request $request)
    {
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
}
