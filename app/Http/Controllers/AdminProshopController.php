<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProshopContent;
use Illuminate\Support\Facades\Storage;

class AdminProshopController extends Controller
{
    // Show admin CMS page
    public function index()
    {
        $description = ProshopContent::whereNotNull('description')->first();
        $images = ProshopContent::whereNotNull('image_path')->get();
        return view('admin.admin_proshop', compact('description', 'images'));
    }

    // Save or update description text
    public function updateDescription(Request $request)
    {
        $request->validate(['description' => 'required|string']);

        $content = ProshopContent::firstOrNew(['id' => 1]); // always one description
        $content->description = $request->description;
        $content->save();

        return back()->with('success', 'Description updated successfully!');
    }

    // Upload multiple images
    public function uploadImages(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('proshop', 'public');
                ProshopContent::create(['image_path' => '/storage/' . $path]);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    // Update single image
    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $img = ProshopContent::findOrFail($id);

        // Delete old file if exists (remove leading /storage/ to match disk path)
        $diskPath = ltrim(str_replace('/storage/', '', $img->image_path), '/');
        if ($img->image_path && Storage::disk('public')->exists($diskPath)) {
            Storage::disk('public')->delete($diskPath);
        }

        // Store new image and save path with /storage/ prefix
        $path = $request->file('image')->store('proshop', 'public');
        $img->update(['image_path' => '/storage/' . $path]);

        return back()->with('success', 'Image updated successfully!');
    }


    // Delete image
    public function deleteImage($id)
    {
        $image = ProshopContent::findOrFail($id);

        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();
        return back()->with('success', 'Image deleted successfully!');
    }
}
