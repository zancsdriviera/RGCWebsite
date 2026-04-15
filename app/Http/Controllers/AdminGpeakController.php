<?php

namespace App\Http\Controllers;

use App\Models\Gpeak;
use App\Models\Gsection;
use Illuminate\Http\Request;

class AdminGpeakController extends Controller
{
    public function index()
    {
        $sections = Gsection::orderBy('order_number')->get();
        $gpeaks   = Gpeak::orderBy('gsection_id')->orderBy('type')->orderBy('sort_order')->get();
        return view('admin.admin_gpeak', compact('sections', 'gpeaks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gsection_id' => 'required|exists:gsections,id',
            'type'        => 'required|in:title,golf_rate',
        ]);

        $max = Gpeak::where('gsection_id', $request->gsection_id)->max('sort_order') ?? 0;
        $data = $request->all();
        $data['sort_order'] = $max + 1;

        // Null out gr_total if empty so it stays nullable
        if (isset($data['gr_total']) && $data['gr_total'] === '') {
            $data['gr_total'] = null;
        }

        Gpeak::create($data);
        return redirect()->back()->with('success', 'Item added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gsection_id' => 'required|exists:gsections,id',
            'type'        => 'required|in:title,golf_rate',
        ]);

        $data = $request->all();
        if (isset($data['gr_total']) && $data['gr_total'] === '') {
            $data['gr_total'] = null;
        }

        Gpeak::findOrFail($id)->update($data);
        return redirect()->back()->with('success', 'Item updated successfully!');
    }

    public function destroy($id)
    {
        Gpeak::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Item deleted successfully!');
    }
}