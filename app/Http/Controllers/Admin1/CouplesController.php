<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouplesCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CouplesController extends Controller
{
    /**
     * Show the Couples editor (can be included in admin_courses.blade.php)
     */
    public function edit()
    {
        $couples = CouplesCourse::first() ?? CouplesCourse::create([
            'title' => 'The Fred Couples Course',
            'description' => 'Designed by everybody’s favorite golfer Freddie Couples...',
        ]);

        return view('admin.couples_edit', compact('couples'));
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

        $couples = CouplesCourse::first() ?? CouplesCourse::create([]);
        $couples->update($request->only('title','description'));

        return back()->with('success','Couples meta updated.');
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

        $couples = CouplesCourse::first() ?? CouplesCourse::create([]);

        if ($couples->{$imageKey}) {
            Storage::disk('public')->delete($couples->{$imageKey});
        }

        $path = $request->file('value')->store('couples', 'public');
        $couples->{$imageKey} = $path;
        $couples->save();

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

        $couples = CouplesCourse::first() ?? CouplesCourse::create([]);

        // Update title/description
        $couples->fill($request->only('title','description'))->save();

        // Update images
        for ($i=1; $i<=6; $i++) {
            $field = "image{$i}";
            if ($request->hasFile($field)) {
                if ($couples->{$field}) Storage::disk('public')->delete($couples->{$field});
                $couples->{$field} = $request->file($field)->store('couples', 'public');
            }
        }

        $couples->save();

        return back()->with('success','Couples course updated successfully.');
    }
}
