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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:20240',
        ]);

        $slug = \Str::slug($request->title) . '-' . time();

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'event_date' => $request->event_date,
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('tournament_thumbs', 'public');
        }

        TournamentGalleryContent::create($data);

        return back()->with('success', 'Tournament gallery created successfully!');
    }


    /** Upload images for a gallery */
    public function storeImages(Request $request, $galleryId)
    {
        $gallery = TournamentGalleryContent::findOrFail($galleryId);

        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'image|max:20240',
        ], [
            'images.required' => 'Please select at least one image to upload.',
            'images.*.image' => 'Please upload valid image files only.',
        ]);

        foreach ($request->file('images', []) as $file) {
        $path = $file->store('galleries/images', 'public');
        $publicPath = '/storage/' . $path;
        GalleryImageContent::create([
            'gallery_id' => $gallery->id,
            'path' => $publicPath,
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
            if ($image->path && file_exists(public_path($image->path))) {
                @unlink(public_path($image->path));
            }
        }

        // Delete thumbnail if exists
        if ($gallery->thumbnail_path && Storage::disk('public')->exists($gallery->thumbnail_path)) {
            Storage::disk('public')->delete($gallery->thumbnail_path);
        }

        $gallery->delete();

        return back()->with('success', 'Gallery deleted successfully!');
    }

    /** Delete single image */
    public function destroyImage($id)
    {
        $image = GalleryImageContent::findOrFail($id);

        if ($image->path && file_exists(public_path($image->path))) {
            @unlink(public_path($image->path));
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }

    /** Update single image (label and/or file) */
    public function updateImage(Request $request, $id)
    {
        $image = GalleryImageContent::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|image|max:20240',
            'label' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($image->path && file_exists(public_path($image->path))) {
                @unlink(public_path($image->path));
            }

            $path = $request->file('image')->store('galleries/images', 'public');
            $image->path = '/storage/' . $path;
        }

        $image->label = $validated['label'] ?? $image->label;
        $image->save();

        return back()->with('success', 'Image updated successfully!');
    }
}
