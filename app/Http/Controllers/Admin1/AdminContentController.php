<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursesContent;
use App\Models\LangerCourse;
use App\Models\CouplesCourse; // ✅ Added
use Illuminate\Support\Facades\Storage;

class AdminContentController extends Controller
{
    /**
     * Admin dashboard redirect
     */
    public function dashboard()
    {
        return redirect()->route('admin.admin_courses', 'courses');
    }

    /**
     * Show admin page editor
     */
    public function showPage($page)
    {
        if ($page === 'courses') {
            $contents = CoursesContent::orderBy('id')->get()->keyBy('key');
            $pagesList = ['courses'];

            // Ensure Langer course exists
            $langer = LangerCourse::first() ?? LangerCourse::create([
                'title' => 'The Bernhard Langer Course',
                'description' => 'Known for being one of the toughest courses in the Philippines, this 7,057 yard par 71 course will test your golf skills.',
            ]);

            // Ensure Couples course exists
            $couples = CouplesCourse::first() ?? CouplesCourse::create([
                'title' => 'The Fred Couples Course',
                'description' => 'Designed by everybody’s favorite golfer Freddie Couples, this 7,102 yard par 72 course is challenging yet enjoyable.',
            ]);

            return view('admin.admin_courses', compact('contents','page','pagesList','langer','couples'));
        }

        // ABOUT US admin page
        if ($page === 'Aboutus') {
            $contents = \App\Models\Aboutus::orderBy('id')->get()->keyBy('key');
            $pagesList = ['Aboutus'];

            return view('admin.Aboutus', compact('contents','page','pagesList'));
        }

        abort(404);
    }

    /**
     * Update generic course content fields
     */
    public function update(Request $request, $key)
    {
        $content = CoursesContent::where('key', $key)->firstOrFail();

        if ($content->type === 'image' && $request->hasFile('value')) {
            if ($content->value && Storage::disk('public')->exists($content->value)) {
                Storage::disk('public')->delete($content->value);
            }

            $path = $request->file('value')->store('content_images', 'public');
            $content->value = $path;
        } else {
            $content->value = $request->input('value');
        }

        $content->save();

        return back()->with('success', 'Course content updated!');
    }

    /**
 * Update Langer course fields (title, description, images)
 */
public function updateLanger(Request $request)
{
    $langer = LangerCourse::firstOrFail();

    // Validation
    $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];
    for ($i = 1; $i <= 6; $i++) {
    $modelField = "image$i";          // database column
    $inputField = "image$i";          // form input name
    if (!$langer->$modelField) {      // only require upload if empty
        $rules[$inputField] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120';
    }
}

    $request->validate($rules);

    $langer->title = $request->input('title');
    $langer->description = $request->input('description');

    for ($i = 1; $i <= 6; $i++) {
        $field = "image$i";
        if ($request->hasFile($field)) {
            if ($langer->$field && Storage::disk('public')->exists($langer->$field)) {
                Storage::disk('public')->delete($langer->$field);
            }
            $langer->$field = $request->file($field)->store('langer_images', 'public');
        }
    }

    $langer->save();

    return back()->with('success','Langer course updated successfully!');
}

/**
 * Update Couples course fields (title, description, images)
 */
public function updateCouples(Request $request)
{
    $couples = CouplesCourse::firstOrFail();

    // Validation rules
    $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    // Only require upload if the corresponding image is empty
    for ($i = 1; $i <= 6; $i++) {
        $inputField = "couples_image$i"; // matches form input name
        $modelField = "image$i";         // actual database column
        if (!$couples->$modelField) {
            $rules[$inputField] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'; // 5MB
        }
    }

    $request->validate($rules);

    // Update title and description
    $couples->title = $request->input('title');
    $couples->description = $request->input('description');

    // Process uploaded images
    for ($i = 1; $i <= 6; $i++) {
        $inputField = "couples_image$i";
        $modelField = "image$i";

        if ($request->hasFile($inputField)) {
            // Delete old image if exists
            if ($couples->$modelField && Storage::disk('public')->exists($couples->$modelField)) {
                Storage::disk('public')->delete($couples->$modelField);
            }
            // Store new image
            $couples->$modelField = $request->file($inputField)->store('couples_images', 'public');
        }
    }

    $couples->save();

    return back()->with('success','Couples course updated successfully!');
}
}
