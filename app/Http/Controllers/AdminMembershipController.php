<?php

namespace App\Http\Controllers;

use App\Models\MembershipContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            'type' => 'required|in:download,applicant,bank',
            // download
            'title' => 'nullable|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
            // applicant
            'name' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0|max:150',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            // bank
            'top_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'qr_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only([
            'type','title','name','company','position','age'
        ]);

        // handle file uploads
        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('membership/files', 'public');
        }
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('membership/avatars', 'public');
        }
        if ($request->hasFile('top_image')) {
            $data['top_image'] = $request->file('top_image')->store('membership/banks', 'public');
        }
        if ($request->hasFile('qr_image')) {
            $data['qr_image'] = $request->file('qr_image')->store('membership/banks', 'public');
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
            'type' => 'required|in:download,applicant,bank',
            // download
            'title' => 'nullable|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf|max:50240',
            // applicant
            'name' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0|max:150',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            // bank
            'top_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'qr_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only([
            'type','title','name','company','position','age'
        ]);

        // replace files if new ones uploaded (delete old)
        if ($request->hasFile('file_path')) {
            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('membership/files', 'public');
        }

        if ($request->hasFile('avatar')) {
            if ($item->avatar && Storage::disk('public')->exists($item->avatar)) {
                Storage::disk('public')->delete($item->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('membership/avatars', 'public');
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

        // delete stored files if present
        foreach (['file_path','avatar','top_image','qr_image'] as $f) {
            if ($item->{$f} && Storage::disk('public')->exists($item->{$f})) {
                Storage::disk('public')->delete($item->{$f});
            }
        }

        $item->delete();

        return redirect()->route('admin.membership.index')->with('success', 'Content deleted.');
    }
}
