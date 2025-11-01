<?php
namespace App\Http\Controllers;

use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseContentController extends Controller
{
    public function index()
    {
        $courses = CourseContent::latest()->get();
        return view('admin.courses_content', compact('courses')); // 👈 updated
    }

    public function client()
    {
        $courses = CourseContent::latest()->get();
        return view('courses_content', compact('courses')); // public client page
    }

    public function store(Request $request)
    {
        $request->validate([
            'title.*' => 'required|string|max:255',
            'body.*' => 'nullable|string',
            'image.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        foreach ($request->title as $i => $title) {
            $path = $request->hasFile("image.$i")
                ? $request->file("image.$i")->store('images', 'public')
                : null;

            CourseContent::create([
                'title' => $title,
                'body' => $request->body[$i] ?? null,
                'image' => $path,
            ]);
        }

        return redirect()->route('admin.courses')->with('success', 'Courses added successfully!');
    }

    public function update(Request $request)
    {
        foreach ($request->course_id as $i => $id) {
            $course = CourseContent::findOrFail($id);

            $data = [
                'title' => $request->title[$i],
                'body' => $request->body[$i],
            ];

            if ($request->hasFile("image.$i")) {
                if ($course->image) Storage::disk('public')->delete($course->image);
                $data['image'] = $request->file("image.$i")->store('images', 'public');
            }

            $course->update($data);
        }

        return redirect()->route('admin.courses')->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
        $course = CourseContent::findOrFail($id);
        if ($course->image) Storage::disk('public')->delete($course->image);
        $course->delete();
        return back()->with('success', 'Course deleted!');
    }
}
