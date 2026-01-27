<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeehouseContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class AdminTeehouseController extends Controller
{
    // Allowed groups and their DB column names
    protected $groups = [
        'lf9' => 'lf9_images',
        'hwl' => 'hwl_images',
        'cf9' => 'cf9_images',
        'hwc' => 'hwc_images',
    ];

    // show admin editor
    public function index()
    {
        $content = TeehouseContent::first();
        return view('admin.admin_teehouse', compact('content'));
    }

    // update description only
    public function updateDescription(Request $request)
    {
        $content = TeehouseContent::firstOrCreate([]);
        $content->description = $request->input('description');
        $content->save();
        return redirect()->back()->with('success', 'Description updated successfully!');
    }

    // upload one or more images for a group (group = lf9, hwl, cf9, hwc)
    public function uploadImages(Request $request, $group)
    {
        if (!array_key_exists($group, $this->groups)) {
            abort(404);
        }

        $col = $this->groups[$group];

        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        $content = TeehouseContent::firstOrCreate([]);
        $images = $content->{$col} ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $this->storeImage($file);
                $images[] = $path;
            }
        }

        $content->{$col} = $images;
        $content->save();

        return redirect()->back()->with('success', 'Images uploaded successfully!');
    }

    // remove single image by group and index
    public function removeImage(Request $request, $group, $index)
    {
        if (!array_key_exists($group, $this->groups)) {
            abort(404);
        }

        $col = $this->groups[$group];
        $content = TeehouseContent::firstOrCreate([]);
        $images = $content->{$col} ?? [];

        if (!isset($images[$index])) {
            return redirect()->back()->with('error', 'Image not found.');
        }

        // delete file from disk
        $this->deleteImageFile($images[$index]);

        array_splice($images, $index, 1);
        $content->{$col} = $images;
        $content->save();

        return redirect()->back()->with('success', 'Image removed successfully!');
    }

    // replace a single image (optional) - update index image
    public function replaceImage(Request $request, $group, $index)
    {
        if (!array_key_exists($group, $this->groups)) {
            abort(404);
        }
        
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);
        
        $col = $this->groups[$group];
        $content = TeehouseContent::firstOrCreate([]);
        $images = $content->{$col} ?? [];

        if (!isset($images[$index])) {
            return redirect()->back()->with('error', 'Image not found.');
        }

        // delete old file
        $this->deleteImageFile($images[$index]);

        $path = $this->storeImage($request->file('image'));
        $images[$index] = $path;

        $content->{$col} = $images;
        $content->save();

        return redirect()->back()->with('success', 'Image updated successfully!');
    }

    /**
     * Store image and return path with /storage/ prefix
     */
    private function storeImage($image): string
{
    $path = $image->store('teehouse', 'public');
    return $path;  // ← Just return the path without '/storage/' prefix
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