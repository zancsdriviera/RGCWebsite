<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    /**
     * Display all courses.
     */
    public function index()
    {
        // Redirect if not logged in as admin
        if (!Session::has('admin')) {
            return redirect()->route('admin.index');
        }

        $courses = Course::latest()->get();
        return view('admin.courses', compact('courses'));
    }

    /**
     * Store a new course.
     */
    public function store(Request $request)
    {
        $request->validate([
            'langer_Mtitle'   => 'required|string|max:255',
            'langer_Mimage' => 'nullable|image',
            'couples_Mtitle'  => 'required|string|max:255',
            'couples_Mimage' => 'nullable|image',

        ]);

        $langerImage = $request->file('langer_Mimage')
            ? $request->file('langer_Mimage')->store('images/courses', 'public')
            : null;

        $couplesImage = $request->file('couples_Mimage')
            ? $request->file('couples_Mimage')->store('images/courses', 'public')
            : null;

        Course::create([
            'langer_Mtitle'  => $request->langer_Mtitle,
            'langer_Mimage'  => $langerImage,
            'couples_Mtitle' => $request->couples_Mtitle,
            'couples_Mimage' => $couplesImage,
        ]);

        return back()->with('success', 'Course added successfully.');
    }

    /**
     * Update an existing course.
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'langer_Mtitle'   => 'required|string|max:255',
            'langer_Mimage' => 'nullable|image',
            'couples_Mtitle'  => 'required|string|max:255',
            'couples_Mimage' => 'nullable|image',
        ]);

        // Update langer_Mimage if new file uploaded
        if ($request->hasFile('langer_Mimage')) {
            if ($course->langer_Mimage && Storage::disk('public')->exists($course->langer_Mimage)) {
                Storage::disk('public')->delete($course->langer_Mimage);
            }
            $course->langer_Mimage = $request->file('langer_Mimage')->store('images/courses', 'public');
        }

        // Update couples_Mimage if new file uploaded
        if ($request->hasFile('couples_Mimage')) {
            if ($course->couples_Mimage && Storage::disk('public')->exists($course->couples_Mimage)) {
                Storage::disk('public')->delete($course->couples_Mimage);
            }
            $course->couples_Mimage = $request->file('couples_Mimage')->store('images/courses', 'public');
        }

        // Update text fields
        $course->update([
            'langer_Mtitle'  => $request->langer_Mtitle,
            'couples_Mtitle' => $request->couples_Mtitle,
            'langer_Mimage'  => $course->langer_Mimage,
            'couples_Mimage' => $course->couples_Mimage,
        ]);

        return back()->with('success', 'Course updated successfully.');
    }

    /**
     * Delete a course.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        // Delete images safely
        foreach (['langer_Mimage', 'couples_Mimage'] as $field) {
            if ($course->$field && Storage::disk('public')->exists($course->$field)) {
                Storage::disk('public')->delete($course->$field);
            }
        }

        $course->delete();

        return back()->with('success', 'Course deleted successfully.');
    }
}
