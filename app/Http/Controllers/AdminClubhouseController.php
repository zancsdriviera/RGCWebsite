<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClubhouseContent;
use Illuminate\Support\Facades\Storage;

class AdminClubhouseController extends Controller
{
    // Show admin CMS page
    public function index()
    {
        $description = ClubhouseContent::whereNotNull('description')->first();
        $images = ClubhouseContent::whereNotNull('image_path')->get();
        return view('admin.admin_clubhouse', compact('description', 'images'));
    }

    // Save or update description text
    public function updateDescription(Request $request)
    {
        $request->validate(['description' => 'required|string']);

        $content = ClubhouseContent::firstOrNew(['id' => 1]); // always one description
        $content->description = $request->description;
        $content->save();

        return back()->with('success', 'Description updated successfully!');
    }

    // Upload multiple images
    public function uploadImages(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $this->storeImage($image);
                ClubhouseContent::create(['image_path' => $path]);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    // Update single image
    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        $img = ClubhouseContent::findOrFail($id);

        // Delete old file if exists
        $this->deleteImageFile($img->image_path);

        // Store new image
        $path = $this->storeImage($request->file('image'));
        $img->update(['image_path' => $path]);

        return back()->with('success', 'Image updated successfully!');
    }

    // Delete image
    public function deleteImage($id)
    {
        $image = ClubhouseContent::findOrFail($id);

        $this->deleteImageFile($image->image_path);

        $image->delete();
        return back()->with('success', 'Image deleted successfully!');
    }

    /**
     * Store image and return path with /storage/ prefix
     */
    private function storeImage($image): string
    {
        $path = $image->store('clubhouse', 'public');
        return '/storage/' . $path;
    }

    /**
     * Delete image file from storage
     */
    private function deleteImageFile(?string $imagePath): void
    {
        if (!$imagePath) {
            return;
        }

        // Remove /storage/ prefix to get disk path
        $diskPath = str_replace('/storage/', '', $imagePath);
        
        if (Storage::disk('public')->exists($diskPath)) {
            Storage::disk('public')->delete($diskPath);
        }
    }
}