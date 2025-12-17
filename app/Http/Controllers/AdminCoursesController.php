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
            'couples_Mtitle' => 'required|string|max:255',
            'couples_Mimage' => 'nullable|image|max:2048',
            'couples_title' => 'nullable|string|max:255',
            'couples_description' => 'nullable|string',
            'couples_images.*' => 'nullable|image|max:2048',
        ]);

        $courseData = [
            'langer_Mtitle' => $request->langer_Mtitle,
            'langer_title' => $request->langer_title,
            'langer_description' => $request->langer_description,
            'langer_images' => [],
            'couples_Mtitle' => $request->couples_Mtitle,
            'couples_title' => $request->couples_title,
            'couples_description' => $request->couples_description,
            'couples_images' => [],
        ];

        if ($request->hasFile('langer_Mimage')) {
            $courseData['langer_Mimage'] = $request->file('langer_Mimage')->store('images/courses', 'public');
        }

        if ($request->hasFile('langer_images')) {
            foreach ($request->file('langer_images') as $image) {
                $courseData['langer_images'][] = $image->store('images/courses/langer', 'public');
            }
        }

        if ($request->hasFile('couples_Mimage')) {
            $courseData['couples_Mimage'] = $request->file('couples_Mimage')->store('images/courses', 'public');
        }

        if ($request->hasFile('couples_images')) {
            foreach ($request->file('couples_images') as $image) {
                $courseData['couples_images'][] = $image->store('images/courses/couples', 'public');
            }
        }

        Course::create($courseData);

        return back()->with('success', 'Course added successfully.');
    }

    // Update course
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'langer_Mtitle' => 'required|string|max:255',
            'langer_Mimage' => 'nullable|image|max:2048',
            'langer_title' => 'nullable|string|max:255',
            'langer_description' => 'nullable|string',
            'langer_images.*' => 'nullable|image|max:2048',
            'delete_langer_images.*' => 'nullable|integer',
            'couples_Mtitle' => 'required|string|max:255',
            'couples_Mimage' => 'nullable|image|max:2048',
            'couples_title' => 'nullable|string|max:255',
            'couples_description' => 'nullable|string',
            'couples_images.*' => 'nullable|image|max:2048',
            'delete_couples_images.*' => 'nullable|integer',
        ]);

        // Update Parent Images
        $this->updateImage($course, $request, 'langer_Mimage');
        $this->updateImage($course, $request, 'couples_Mimage');

        // Update Parent Titles
        $course->update([
            'langer_Mtitle' => $request->langer_Mtitle,
            'langer_title' => $request->langer_title,
            'langer_description' => $request->langer_description,
            'couples_Mtitle' => $request->couples_Mtitle,
            'couples_title' => $request->couples_title,
            'couples_description' => $request->couples_description,
        ]);

        // Handle Langer Gallery
        $this->updateGallery($course, $request, 'langer_images', 'delete_langer_images', 'images/courses/langer');

        // Handle Couples Gallery
        $this->updateGallery($course, $request, 'couples_images', 'delete_couples_images', 'images/courses/couples');

        return back()->with('success', 'Course updated successfully.');
    }

    private function updateImage($course, $request, $field)
    {
        if ($request->hasFile($field)) {
            if ($course->$field && Storage::disk('public')->exists($course->$field)) {
                Storage::disk('public')->delete($course->$field);
            }
            $course->$field = $request->file($field)->store('images/courses', 'public');
            $course->save();
        }
    }

    private function updateGallery($course, $request, $field, $deleteField, $storagePath)
    {
        $images = $course->$field ?? [];

        // Delete selected images
        if ($request->has($deleteField)) {
            $toKeep = [];
            foreach ($images as $index => $imgPath) {
                if (!in_array($index, $request->$deleteField)) {
                    $toKeep[] = $imgPath;
                } else {
                    Storage::disk('public')->delete($imgPath);
                }
            }
            $images = $toKeep;
        }

        // Add new images
        if ($request->hasFile($field)) {
            foreach ($request->file($field) as $img) {
                $images[] = $img->store($storagePath, 'public');
            }
        }

        $course->$field = $images;
        $course->save();
    }

    // Delete course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        $fieldsToDelete = ['langer_Mimage', 'couples_Mimage'];
        foreach ($fieldsToDelete as $field) {
            if ($course->$field) Storage::disk('public')->delete($course->$field);
        }

        $galleries = ['langer_images', 'couples_images'];
        foreach ($galleries as $gallery) {
            if ($course->$gallery) {
                foreach ($course->$gallery as $imgPath) {
                    Storage::disk('public')->delete($imgPath);
                }
            }
        }

        $course->delete();
        return back()->with('success', 'Course deleted successfully.');
    }
}
