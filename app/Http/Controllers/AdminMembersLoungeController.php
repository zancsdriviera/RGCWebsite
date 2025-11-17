<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembersLoungeContent;
use Illuminate\Support\Facades\Storage;

class AdminMembersLoungeController extends Controller
{
    // Show admin CMS page
    public function index()
    {
        $description = MembersLoungeContent::whereNotNull('description')->first();
        $images = MembersLoungeContent::whereNotNull('image_path')->get();
        return view('admin.admin_membersLounge', compact('description', 'images'));
    }

    // Save or update description text
    public function updateDescription(Request $request)
    {
        $request->validate(['description' => 'required|string']);

        $content = MembersLoungeContent::firstOrNew(['id' => 1]); // always one description
        $content->description = $request->description;
        $content->save();

        return back()->with('success', 'Description updated successfully!');
    }

    // Upload multiple images
    public function uploadImages(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:20240',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('membersLounge', 'public');
                MembersLoungeContent::create(['image_path' => '/storage/' . $path]);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    // Update single image
    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:20240',
        ]);

        $img = MembersLoungeContent::findOrFail($id);

        // Delete old file if exists (remove leading /storage/ to match disk path)
        $diskPath = ltrim(str_replace('/storage/', '', $img->image_path), '/');
        if ($img->image_path && Storage::disk('public')->exists($diskPath)) {
            Storage::disk('public')->delete($diskPath);
        }

        // Store new image and save path with /storage/ prefix
        $path = $request->file('image')->store('membersLounge', 'public');
        $img->update(['image_path' => '/storage/' . $path]);

        return back()->with('success', 'Image updated successfully!');
    }


    // Delete image
    public function deleteImage($id)
    {
        $image = MembersLoungeContent::findOrFail($id);

        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();
        return back()->with('success', 'Image deleted successfully!');
    }
}
