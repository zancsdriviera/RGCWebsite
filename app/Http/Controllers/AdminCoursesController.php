<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class AdminCoursesController extends Controller
{
    // Display admin page
    public function index()
    {
        $courses = Course::all();
        return view('admin.admin_courses', compact('courses'));
    }

    // Store new course
    public function store(Request $request)
    {
        $request->validate([
            'langer_Mtitle' => 'required|string|max:255',
            'langer_Mimage' => 'nullable|image|max:2048',
            'langer_title' => 'nullable|string|max:255',
            'langer_description' => 'nullable|string',
            'langer_images.*' => 'nullable|image|max:2048',
            'langer_holes.*' => 'nullable|integer',
            'couples_Mtitle' => 'required|string|max:255',
            'couples_Mimage' => 'nullable|image|max:2048',
            'couples_title' => 'nullable|string|max:255',
            'couples_description' => 'nullable|string',
            'couples_images.*' => 'nullable|image|max:2048',
            'couples_holes.*' => 'nullable|integer',
        ]);

        $courseData = [
            'langer_Mtitle' => $request->langer_Mtitle,
            'langer_title' => $request->langer_title,
            'langer_description' => $request->langer_description,
            'langer_images' => $this->processGallery($request->file('langer_images'), $request->langer_holes, 'images/courses/langer'),
            'couples_Mtitle' => $request->couples_Mtitle,
            'couples_title' => $request->couples_title,
            'couples_description' => $request->couples_description,
            'couples_images' => $this->processGallery($request->file('couples_images'), $request->couples_holes, 'images/courses/couples'),
        ];

        if ($request->hasFile('langer_Mimage')) {
            $courseData['langer_Mimage'] = $request->file('langer_Mimage')->store('images/courses', 'public');
        }

        if ($request->hasFile('couples_Mimage')) {
            $courseData['couples_Mimage'] = $request->file('couples_Mimage')->store('images/courses', 'public');
        }

        Course::create($courseData);

        return back()->with('modal_message', 'Course added successfully.');
    }

    // Update course titles, parent images, and gallery holes
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'langer_Mtitle' => 'required|string|max:255',
            'langer_Mimage' => 'nullable|image|max:2048',
            'langer_title' => 'nullable|string|max:255',
            'langer_description' => 'nullable|string',
            'existing_langer_holes.*' => 'nullable|integer',
            'couples_Mtitle' => 'required|string|max:255',
            'couples_Mimage' => 'nullable|image|max:2048',
            'couples_title' => 'nullable|string|max:255',
            'couples_description' => 'nullable|string',
            'existing_couples_holes.*' => 'nullable|integer',
        ]);

        // Update parent images
        $this->updateImage($course, $request, 'langer_Mimage');
        $this->updateImage($course, $request, 'couples_Mimage');

        // Update titles/descriptions
        $course->update([
            'langer_Mtitle' => $request->langer_Mtitle,
            'langer_title' => $request->langer_title,
            'langer_description' => $request->langer_description,
            'couples_Mtitle' => $request->couples_Mtitle,
            'couples_title' => $request->couples_title,
            'couples_description' => $request->couples_description,
        ]);

        // Update gallery hole numbers
        $course->langer_images = $this->updateHoles($course->langer_images ?? [], $request->existing_langer_holes ?? []);
        $course->couples_images = $this->updateHoles($course->couples_images ?? [], $request->existing_couples_holes ?? []);

        $course->save();

        return back()->with('modal_message', 'Course updated successfully.');
    }

    // Update hole numbers for a gallery
    private function updateHoles($images, $holes)
    {
        foreach ($holes as $index => $hole) {
            if (isset($images[$index])) {
                $images[$index]['hole'] = $hole;
            }
        }
        return $images;
    }

    // Update parent image
    private function updateImage($course, $request, $field)
    {
        if ($request->hasFile($field)) {
            if ($course->$field && Storage::disk('public')->exists($course->$field)) {
                Storage::disk('public')->delete($course->$field);
            }
            $course->$field = $request->file($field)->store('images/courses', 'public');
        }
    }

    // Per-image update (hole number or replace image)
    public function updateImageField(Request $request, $id, $type, $index)
    {
        $course = Course::findOrFail($id);
        $images = $course->{$type . '_images'} ?? [];

        if (!isset($images[$index])) {
            return back()->with('error', 'Image not found.');
        }

        // Update hole number
        if ($request->has('hole')) {
            $images[$index]['hole'] = $request->hole;
        }

        // Replace image file if new one uploaded
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($images[$index]['image']);
            $images[$index]['image'] = $request->file('image')->store('images/courses/' . $type, 'public');
        }

        $course->{$type . '_images'} = $images;
        $course->save();

        return back()->with('modal_message', 'Image updated successfully.');
    }

    // Delete single gallery image
    public function deleteImageField($id, $type, $index)
    {
        $course = Course::findOrFail($id);
        $images = $course->{$type . '_images'} ?? [];

        if (!isset($images[$index])) {
            return back()->with('error', 'Image not found.');
        }

        Storage::disk('public')->delete($images[$index]['image']);
        unset($images[$index]);

        $course->{$type . '_images'} = array_values($images);
        $course->save();

        return back()->with('modal_message', 'Image deleted successfully.');
    }

    // Add multiple new images to gallery
    public function addImageField(Request $request, $id, $type)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|max:2048',
            'holes' => 'nullable|array',
            'holes.*' => 'nullable|integer',
        ]);

        $images = $course->{$type . '_images'} ?? [];
        $uploadedImages = $request->file('images');
        $holes = $request->holes ?? [];

        foreach ($uploadedImages as $key => $image) {
            $images[] = [
                'image' => $image->store('images/courses/' . $type, 'public'),
                'hole' => $holes[$key] ?? null,
            ];
        }

        $course->{$type . '_images'} = $images;
        $course->save();

        return back()->with('modal_message', count($uploadedImages) . ' image(s) added successfully.');
    }

    // Delete course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        // Delete parent images
        foreach (['langer_Mimage', 'couples_Mimage'] as $field) {
            if ($course->$field) Storage::disk('public')->delete($course->$field);
        }

        // Delete gallery images
        foreach (['langer_images', 'couples_images'] as $gallery) {
            if ($course->$gallery) {
                foreach ($course->$gallery as $img) {
                    Storage::disk('public')->delete($img['image']);
                }
            }
        }

        $course->delete();
        return back()->with('modal_message', 'Course deleted successfully.');
    }

    // Helper to process uploaded gallery files
    private function processGallery($files, $holes, $storagePath)
    {
        $gallery = [];
        if ($files) {
            foreach ($files as $key => $file) {
                $gallery[] = [
                    'image' => $file->store($storagePath, 'public'),
                    'hole' => $holes[$key] ?? null,
                ];
            }
        }
        return $gallery;
    }
}
