<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TournamentGalleryContent;
use App\Models\GalleryImageContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminTournamentGalleryController extends Controller
{
    /** Show all tournament galleries */
    public function index()
    {
        $galleries = TournamentGalleryContent::withCount('images')
            ->orderByDesc('event_date')
            ->get();

        return view('admin.admin_tournament_gallery', compact('galleries'));
    }

    /** Create new gallery */
    public function storeGallery(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        $slug = Str::slug($request->title) . '-' . time();

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'event_date' => $request->event_date,
            'thumbnail_path' => $this->storeImage($request->file('thumbnail'), 'tournament_thumbs')
        ];

        TournamentGalleryContent::create($data);

        return back()->with('success', 'Tournament gallery created successfully!');
    }

    /** Upload images for a gallery */
    public function storeImages(Request $request, $galleryId)
    {
        $gallery = TournamentGalleryContent::findOrFail($galleryId);

        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ], [
            'images.required' => 'Please select at least one image to upload.',
            'images.*.image' => 'Please upload valid image files only.',
            'images.*.max' => 'Each image must not exceed 5MB.',
        ]);

        foreach ($request->file('images', []) as $file) {
            $path = $this->storeImage($file, 'galleries/images');
            
            GalleryImageContent::create([
                'gallery_id' => $gallery->id,
                'path' => $path,
                'label' => null,
                'sort_order' => 0,
            ]);
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    /** Delete entire gallery with cascade delete on images */
    public function destroyGallery($id)
    {
        $gallery = TournamentGalleryContent::findOrFail($id);

        // Delete images from storage
        foreach ($gallery->images as $image) {
            $this->deleteImageFile($image->path);
        }

        // Delete thumbnail if exists
        $this->deleteImageFile($gallery->thumbnail_path);

        $gallery->delete();

        return back()->with('success', 'Gallery deleted successfully!');
    }

    /** Delete single image */
    public function destroyImage($id)
    {
        $image = GalleryImageContent::findOrFail($id);

        $this->deleteImageFile($image->path);

        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }

    /** Update single image (label and/or file) */
    public function updateImage(Request $request, $id)
    {
        $image = GalleryImageContent::findOrFail($id);

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            $this->deleteImageFile($image->path);

            // Store new image
            $path = $this->storeImage($request->file('image'), 'galleries/images');
            $image->path = $path;
        }

        $image->save();

        return back()->with('success', 'Image updated successfully!');
    }

    /** Update gallery thumbnail */
    public function updateThumbnail(Request $request, $id)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        $gallery = TournamentGalleryContent::findOrFail($id);

        // Delete old thumbnail
        $this->deleteImageFile($gallery->thumbnail_path);

        // Save new thumbnail
        $path = $this->storeImage($request->file('thumbnail'), 'gallery_thumbnails');
        $gallery->thumbnail_path = $path;
        $gallery->save();

        return back()->with('success', 'Thumbnail updated successfully!');
    }

    /**
     * Store image and return path with /storage/ prefix
     */
    private function storeImage($image, string $directory): string
    {
        $path = $image->store($directory, 'public');
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