<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminAnnouncementController extends Controller
{
    public function index()
    {
        $announcements = AnnouncementContent::orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.admin_announcement', compact('announcements'));
    }

    public function store(Request $request)
    {
        // Make sure the checkbox always has a value.
        $request->merge([
            'is_published' => $request->boolean('is_published'),
        ]);

        $validated = $request->validate(
            [
                'title' => 'required|string|max:255',
                'content' => 'nullable|string',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
                'is_published' => 'boolean',
                'published_date' => 'nullable|date',
                'order' => 'nullable|integer',
            ],
            [
                'featured_image.max' =>
                    'The featured image is too large. Please upload an image that is 3 MB or smaller.',

                'featured_image.image' =>
                    'The featured image must be a valid image.',

                'featured_image.mimes' =>
                    'The featured image must be a JPG, JPEG, or PNG file.',

                'title.required' =>
                    'Please enter an announcement title.',

                'title.max' =>
                    'The announcement title cannot exceed 255 characters.',

                'order.integer' =>
                    'The order must be a whole number.',
            ]
        );

        $slug = Str::slug($validated['title']);

        $originalSlug = $slug;

        $count = 1;

        while (AnnouncementContent::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $validated['slug'] = $slug;

        if ($request->hasFile('featured_image')) {

            $path = $request->file('featured_image')
                ->store('announcements', 'public');

            $validated['featured_image'] = $path;
        }

        AnnouncementContent::create($validated);

        return redirect()
            ->route('admin.announcement.index')
            ->with('success', 'Announcement created successfully!');
    }


    public function update(Request $request, $id)
    {
        $announcement = AnnouncementContent::findOrFail($id);

        // Make sure the checkbox always has a value.
        $request->merge([
            'is_published' => $request->boolean('is_published'),
        ]);

        $validated = $request->validate(
            [
                'title' => 'required|string|max:255',
                'content' => 'nullable|string',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
                'is_published' => 'boolean',
                'published_date' => 'nullable|date',
                'order' => 'nullable|integer',
            ],
            [
                'featured_image.max' =>
                    'The featured image is too large. Please upload an image that is 2 MB or smaller.',

                'featured_image.image' =>
                    'The featured image must be a valid image.',

                'featured_image.mimes' =>
                    'The featured image must be a JPG, JPEG, or PNG file.',

                'title.required' =>
                    'Please enter an announcement title.',

                'title.max' =>
                    'The announcement title cannot exceed 255 characters.',

                'order.integer' =>
                    'The order must be a whole number.',
            ]
        );

        /*
         * Generate a new slug if the title was changed.
         */
        if ($announcement->title !== $validated['title']) {

            $slug = Str::slug($validated['title']);

            $originalSlug = $slug;

            $count = 1;

            while (
                AnnouncementContent::where('slug', $slug)
                    ->where('id', '!=', $id)
                    ->exists()
            ) {
                $slug = $originalSlug . '-' . $count++;
            }

            $validated['slug'] = $slug;
        }


        /*
         * Replace the existing image only when a new image
         * has actually been uploaded.
         */
        if ($request->hasFile('featured_image')) {

            if (
                $announcement->featured_image &&
                Storage::disk('public')->exists(
                    $announcement->featured_image
                )
            ) {
                Storage::disk('public')->delete(
                    $announcement->featured_image
                );
            }

            $path = $request->file('featured_image')
                ->store('announcements', 'public');

            $validated['featured_image'] = $path;
        }


        $announcement->update($validated);

        return redirect()
            ->route('admin.announcement.index')
            ->with('success', 'Announcement updated successfully!');
    }


    public function destroy($id)
    {
        $announcement = AnnouncementContent::findOrFail($id);

        if (
            $announcement->featured_image &&
            Storage::disk('public')->exists(
                $announcement->featured_image
            )
        ) {
            Storage::disk('public')->delete(
                $announcement->featured_image
            );
        }

        $announcement->delete();

        return redirect()
            ->route('admin.announcement.index')
            ->with('success', 'Announcement deleted successfully!');
    }


    public function updateOrder(Request $request, $id)
    {
        $announcement = AnnouncementContent::findOrFail($id);

        $announcement->update([
            'order' => $request->order
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
