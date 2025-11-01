<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LangerCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LangerController extends Controller
{
    /**
     * Show the Langer editor (can be included in admin_courses.blade.php)
     */
    public function edit()
    {
        // fetch first row or create default
        $langer = LangerCourse::first() ?? LangerCourse::create([
            'title' => 'The Bernhard Langer Course',
            'description' => 'Known For Being One Of The Toughest Courses In The Philippines...',
        ]);

        return view('admin.langer_edit', compact('langer'));
    }

    /**
     * Update title and description
     */
    public function updateMeta(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $langer = LangerCourse::first() ?? LangerCourse::create([]);

        $langer->update($request->only('title','description'));

        return back()->with('success','Langer meta updated.');
    }

    /**
     * Update single image (image1..image6)
     */
    public function updateImage(Request $request, $imageKey)
    {
        $allowed = ['image1','image2','image3','image4','image5','image6'];
        if (! in_array($imageKey, $allowed)) abort(404);

        $request->validate([
            'value' => 'required|image|max:5120', // 5MB
        ]);

        $langer = LangerCourse::first() ?? LangerCourse::create([]);

        // Delete old image if exists
        if ($langer->{$imageKey}) {
            Storage::disk('public')->delete($langer->{$imageKey});
        }

        $path = $request->file('value')->store('langer', 'public');
        $langer->{$imageKey} = $path;
        $langer->save();

        return back()->with('success', ucfirst($imageKey).' updated.');
    }

    /**
     * Bulk update: all images + meta in one request
     */
    public function updateAll(Request $request)
    {
        $rules = [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ];

        // Validate all six images
        for ($i=1; $i<=6; $i++) {
            $rules["image{$i}"] = 'nullable|image|max:5120';
        }

        $request->validate($rules);

        $langer = LangerCourse::first() ?? LangerCourse::create([]);

        // Update title/description
        $langer->fill($request->only('title','description'))->save();

        // Update images
        for ($i=1; $i<=6; $i++) {
            $field = "image{$i}";
            if ($request->hasFile($field)) {
                if ($langer->{$field}) Storage::disk('public')->delete($langer->{$field});
                $langer->{$field} = $request->file($field)->store('langer', 'public');
            }
        }

        $langer->save();

        return back()->with('success','Langer course updated successfully.');
    }
}
