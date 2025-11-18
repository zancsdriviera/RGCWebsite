<?php

namespace App\Http\Controllers;

use App\Models\DefinitiveContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDefinitiveController extends Controller
{
    public function index()
    {
        $docs = DefinitiveContent::orderBy('year', 'desc')->get();
        return view('admin.admin_definitive', compact('docs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|unique:definitive_contents,year',
            'file' => 'required|mimes:pdf|max:20480'
        ]);

        $path = $request->file('file')->store('definitive', 'public');

        DefinitiveContent::create([
            'year' => $request->year,
            'file_path' => $path
        ]);

        return redirect()->back()->with('success', 'Document uploaded successfully!');
    }

    public function update(Request $request, $id)
    {
        $doc = DefinitiveContent::findOrFail($id);

        $request->validate([
            'year' => 'required|integer|unique:definitive_contents,year,' . $doc->id,
            'file' => 'nullable|mimes:pdf|max:20480'
        ]);

        $doc->year = $request->year;

        if ($request->hasFile('file')) {
            if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
                Storage::disk('public')->delete($doc->file_path);
            }
            $doc->file_path = $request->file('file')->store('definitive', 'public');
        }

        $doc->save();

        return redirect()->back()->with('success', 'Document updated successfully!');
    }

    public function destroy($id)
    {
        $doc = DefinitiveContent::findOrFail($id);

        if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
            Storage::disk('public')->delete($doc->file_path);
        }

        $doc->delete();

        return redirect()->back()->with('success', 'Document deleted successfully!');
    }
}
