<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminCoursesController extends Controller
{
    /**
     * Display a paired list of courses (left / right)
     */
    public function index(Request $request)
{
    $courses = Course::all(); // get all rows as-is
    return view('admin.admin_courses', compact('courses'));
}


    /**
     * Store a new course
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

    /**
     * Dashboard redirect
     */
    public function dashboard(Request $request)
    {
        return $this->index($request);
    }
}
