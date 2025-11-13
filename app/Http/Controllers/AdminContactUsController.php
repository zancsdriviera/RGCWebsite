<?php

namespace App\Http\Controllers;

use App\Models\ContactUsContent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminContactUsController extends Controller
{
    /**
     * Show admin contact-us CMS
     */
    public function index()
    {
        // single main contact (should be only one)
        $main = ContactUsContent::where('type', 'main')->first();

        // departments list
        $departments = ContactUsContent::where('type', 'department')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.admin_contactUs', compact('main', 'departments'));
    }

    /**
     * Update main contact (address + main_phone)
     */
public function updateMain(Request $request)
{
    // create validator instead of $request->validate()
    $validator = Validator::make($request->all(), [
        'address' => 'required|string|max:500',
        'main_phone' => 'required|string|max:50',
    ], [
        'address.required' => 'The address field is required.',
        'main_phone.required' => 'The main contact number is required.',
    ]);

    if ($validator->fails()) {
        // redirect back with validation errors but WITHOUT old input
        // (no withInput() so old() will fall back to DB values)
        return redirect()->back()
                         ->withErrors($validator)
                         ->with('error', 'Please fix the errors and try again.');
    }

    // Save or update
    ContactUsContent::updateOrCreate(
        ['type' => 'main'],
        [
            'address' => $request->input('address'),
            'main_phone' => $request->input('main_phone'),
        ]
    );

    return redirect()->back()->with('success', 'Main contact details updated successfully!');
}


    /**
     * Store department
     */
    public function storeDepartment(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'phone' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:191',
        ]);

        ContactUsContent::create([
            'type' => 'department',
            'title' => $request->title,
            'phone' => $request->phone,
            'email' => $request->email,
            'sort_order' => $request->input('sort_order', 0),
        ]);

        return redirect()->route('admin.contact.index')->with('success', 'Department added.');
    }

    /**
     * Update department
     */
    public function updateDepartment(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Find the department record
        $department = ContactUsContent::where('type', 'department')->findOrFail($id);

        // Update the fields
        $department->update([
            'title' => $validated['title'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.contact.index')->with('success', 'Department updated.');
    }
    /**
     * Delete department
     */
    public function destroyDepartment($id)
    {
        $item = ContactUsContent::where('type', 'department')->findOrFail($id);
        $item->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Department deleted.');
    }
}
