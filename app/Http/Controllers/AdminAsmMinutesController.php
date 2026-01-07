<?php

namespace App\Http\Controllers;

use App\Models\AsmMinutesContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAsmMinutesController extends Controller
{
    public function index()
    {
        $docs = AsmMinutesContent::orderBy('meeting_date', 'desc')->get();
        return view('admin.admin_asm_minutes', compact('docs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'meeting_date' => 'required|date|unique:asm_minutes_contents,meeting_date',
            'file' => 'required|mimes:pdf|max:20480'
        ]);

        $path = $request->file('file')->store('asm_minutes', 'public');

        AsmMinutesContent::create([
            'meeting_date' => $request->meeting_date,
            'file_path' => $path
        ]);

        return redirect()->back()->with('success', 'Document uploaded successfully!');
    }

    public function update(Request $request, $id)
    {
        $doc = AsmMinutesContent::findOrFail($id);

        $request->validate([
            'meeting_date' => 'required|date|unique:asm_minutes_contents,meeting_date,' . $doc->id,
            'file' => 'nullable|mimes:pdf|max:20480'
        ]);

        $doc->meeting_date = $request->meeting_date;

        if ($request->hasFile('file')) {
            if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
                Storage::disk('public')->delete($doc->file_path);
            }
            $doc->file_path = $request->file('file')->store('asm_minutes', 'public');
        }

        $doc->save();

        return redirect()->back()->with('success', 'Document updated successfully!');
    }

    public function destroy($id)
    {
        $doc = AsmMinutesContent::findOrFail($id);

        if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
            Storage::disk('public')->delete($doc->file_path);
        }

        $doc->delete();

        return redirect()->back()->with('success', 'Document deleted successfully!');
    }
}