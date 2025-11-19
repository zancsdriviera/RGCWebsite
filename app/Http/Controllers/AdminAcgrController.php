<?php

namespace App\Http\Controllers;

use App\Models\AcgrContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAcgrController extends Controller
{
    public function index()
    {
        $docs = AcgrContent::orderBy('year', 'desc')->get();
        return view('admin.admin_acgr', compact('docs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|unique:acgr_contents,year',
            'file' => 'required|mimes:pdf|max:20480'
        ]);

        $path = $request->file('file')->store('acgr', 'public');

        AcgrContent::create([
            'year' => $request->year,
            'file_path' => $path
        ]);

        return redirect()->back()->with('success', 'Document uploaded successfully!');
    }

    public function update(Request $request, $id)
    {
        $doc = AcgrContent::findOrFail($id);

        $request->validate([
            'year' => 'required|integer|unique:acgr_contents,year,' . $doc->id,
            'file' => 'nullable|mimes:pdf|max:20480'
        ]);

        $doc->year = $request->year;

        if ($request->hasFile('file')) {
            if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
                Storage::disk('public')->delete($doc->file_path);
            }
            $doc->file_path = $request->file('file')->store('acgr', 'public');
        }

        $doc->save();

        return redirect()->back()->with('success', 'Document updated successfully!');
    }

    public function destroy($id)
    {
        $doc = AcgrContent::findOrFail($id);

        if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
            Storage::disk('public')->delete($doc->file_path);
        }

        $doc->delete();

        return redirect()->back()->with('success', 'Document deleted successfully!');
    }
}
