<?php

namespace App\Http\Controllers;

use App\Models\MembershipContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMembershipController extends Controller
{
    /**
     * Show CMS list & form page
     */
    public function index()
    {
        $contents = MembershipContent::orderBy('type')->orderByDesc('id')->get();
        return view('admin.admin_membership', compact('contents'));
    }

    /**
     * Store new content (download, applicant, bank)
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:download,members_data,bank',
            'title' => 'nullable|string|max:255',
            'file_path' => 'nullable|mimetypes:application/pdf,image/jpeg,image/png,image/webp|max:10240',
            'top_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20240',
            'qr_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20240',
        ]);

        $data = $request->only(['type', 'title']);

        // Handle file upload for all types
        if ($request->hasFile('download_file')) {
            $data['file_path'] = $request->file('download_file')->store('membership/files', 'public');
        }

        if ($request->hasFile('members_image')) {
            $data['file_path'] = $request->file('members_image')->store('membership/files', 'public');
        }

        if ($request->hasFile('bank_top_image')) {
            $data['top_image'] = $request->file('bank_top_image')->store('membership/banks', 'public');
        }

        if ($request->hasFile('bank_qr_image')) {
            $data['qr_image'] = $request->file('bank_qr_image')->store('membership/banks', 'public');
        }

        MembershipContent::create($data);

        return redirect()->route('admin.membership.index')->with('success', 'Content added.');
    }


    /**
     * Update content
     */
    public function update(Request $request, $id)
    {
        $item = MembershipContent::findOrFail($id);

        $request->validate([
            'type' => 'required|in:download,members_data,bank',
            'title' => 'nullable|string|max:255',
           'file_path' => 'nullable|mimetypes:application/pdf,image/jpeg,image/png,image/webp|max:10240',
            'top_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20240',
            'qr_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20240',
        ]);

        $data = $request->only(['type', 'title']);

        // replace uploaded files if present
        if ($request->hasFile('file_path')) {
            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('membership/files', 'public');
        }

        if ($request->hasFile('top_image')) {
            if ($item->top_image && Storage::disk('public')->exists($item->top_image)) {
                Storage::disk('public')->delete($item->top_image);
            }
            $data['top_image'] = $request->file('top_image')->store('membership/banks', 'public');
        }

        if ($request->hasFile('qr_image')) {
            if ($item->qr_image && Storage::disk('public')->exists($item->qr_image)) {
                Storage::disk('public')->delete($item->qr_image);
            }
            $data['qr_image'] = $request->file('qr_image')->store('membership/banks', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.membership.index')->with('success', 'Content updated.');
    }

    /**
     * Delete content
     */
    public function destroy($id)
    {
        $item = MembershipContent::findOrFail($id);

        foreach (['file_path','top_image','qr_image'] as $f) {
            if ($item->{$f} && Storage::disk('public')->exists($item->{$f})) {
                Storage::disk('public')->delete($item->{$f});
            }
        }

        $item->delete();

        return redirect()->route('admin.membership.index')->with('success', 'Content deleted.');
    }
}
