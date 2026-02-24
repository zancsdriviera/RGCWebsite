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

    // Update the store method to handle new fields
    public function store(Request $request)
    {
        $request->validate([
            'langer_Mtitle' => 'required|string|max:255',
            'langer_Mimage' => 'nullable|image|max:5120',
            'langer_title' => 'nullable|string|max:255',
            'langer_description' => 'nullable|string',
            'langer_images.*' => 'nullable|image|max:5120',
            'langer_holes.*' => 'nullable|integer',
            'langer_par.*' => 'nullable|integer|min:3|max:6',
            'langer_gold.*' => 'nullable|integer|min:0',
            'langer_blue.*' => 'nullable|integer|min:0',
            'langer_white.*' => 'nullable|integer|min:0',
            'langer_red.*' => 'nullable|integer|min:0',
            
            'couples_Mtitle' => 'required|string|max:255',
            'couples_Mimage' => 'nullable|image|max:5120',
            'couples_title' => 'nullable|string|max:255',
            'couples_description' => 'nullable|string',
            'couples_images.*' => 'nullable|image|max:5120',
            'couples_holes.*' => 'nullable|integer',
            'couples_par.*' => 'nullable|integer|min:3|max:6',
            'couples_gold.*' => 'nullable|integer|min:0',
            'couples_blue.*' => 'nullable|integer|min:0',
            'couples_white.*' => 'nullable|integer|min:0',
            'couples_red.*' => 'nullable|integer|min:0',
        ]);

        $courseData = [
            'langer_Mtitle' => $request->langer_Mtitle,
            'langer_title' => $request->langer_title,
            'langer_description' => $request->langer_description,
            'langer_images' => $this->processGallery(
                $request->file('langer_images'), 
                $request->langer_holes,
                $request->langer_par,
                $request->langer_gold,
                $request->langer_blue,
                $request->langer_white,
                $request->langer_red,
                'images/courses/langer'
            ),
            'couples_Mtitle' => $request->couples_Mtitle,
            'couples_title' => $request->couples_title,
            'couples_description' => $request->couples_description,
            'couples_images' => $this->processGallery(
                $request->file('couples_images'), 
                $request->couples_holes,
                $request->couples_par,
                $request->couples_gold,
                $request->couples_blue,
                $request->couples_white,
                $request->couples_red,
                'images/courses/couples'
            ),
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
    // Update course titles, parent images, and gallery holes
public function update(Request $request, $id)
{
    $course = Course::findOrFail($id);

    $rules = [];
    
    // Only validate langer fields if they're present in the request
    if ($request->has('langer_Mtitle')) {
        $rules['langer_Mtitle'] = 'required|string|max:255';
        $rules['langer_Mimage'] = 'nullable|image|max:5120';
        $rules['langer_title'] = 'nullable|string|max:255';
        $rules['langer_description'] = 'nullable|string';
        // Note: existing_langer_holes validation removed since you're not using it in separate forms
    }
    
    // Only validate couples fields if they're present in the request
    if ($request->has('couples_Mtitle')) {
        $rules['couples_Mtitle'] = 'required|string|max:255';
        $rules['couples_Mimage'] = 'nullable|image|max:5120';
        $rules['couples_title'] = 'nullable|string|max:255';
        $rules['couples_description'] = 'nullable|string';
        // Note: existing_couples_holes validation removed since you're not using it in separate forms
    }
    
    $request->validate($rules);

    // Update parent images
    if ($request->hasFile('langer_Mimage')) {
        $this->updateImage($course, $request, 'langer_Mimage');
    }
    
    if ($request->hasFile('couples_Mimage')) {
        $this->updateImage($course, $request, 'couples_Mimage');
    }

    // Update only the fields that are present in the request
    $updateData = [];
    
    if ($request->has('langer_Mtitle')) {
        $updateData['langer_Mtitle'] = $request->langer_Mtitle;
        $updateData['langer_title'] = $request->langer_title ?? $course->langer_title;
        $updateData['langer_description'] = $request->langer_description ?? $course->langer_description;
    }
    
    if ($request->has('couples_Mtitle')) {
        $updateData['couples_Mtitle'] = $request->couples_Mtitle;
        $updateData['couples_title'] = $request->couples_title ?? $course->couples_title;
        $updateData['couples_description'] = $request->couples_description ?? $course->couples_description;
    }

    // Only update if there's data to update
    if (!empty($updateData)) {
        $course->update($updateData);
    }

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

    // Update the updateImageField method to handle new fields
    public function updateImageField(Request $request, $id, $type, $index)
    {
        $course = Course::findOrFail($id);
        $images = $course->{$type . '_images'} ?? [];

        if (!isset($images[$index])) {
            return back()->with('error', 'Image not found.');
        }

        // Update all fields
        if ($request->has('hole')) {
            $images[$index]['hole'] = $request->hole;
        }
        if ($request->has('par')) {
            $images[$index]['par'] = $request->par;
        }
        if ($request->has('gold')) {
            $images[$index]['gold'] = $request->gold;
        }
        if ($request->has('blue')) {
            $images[$index]['blue'] = $request->blue;
        }
        if ($request->has('white')) {
            $images[$index]['white'] = $request->white;
        }
        if ($request->has('red')) {
            $images[$index]['red'] = $request->red;
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

    // Update addImageField method
    public function addImageField(Request $request, $id, $type)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|max:5120',
            'holes' => 'nullable|array',
            'holes.*' => 'nullable|integer',
            'pars' => 'nullable|array',
            'pars.*' => 'nullable|integer|min:3|max:6',
            'golds' => 'nullable|array',
            'golds.*' => 'nullable|integer|min:0',
            'blues' => 'nullable|array',
            'blues.*' => 'nullable|integer|min:0',
            'whites' => 'nullable|array',
            'whites.*' => 'nullable|integer|min:0',
            'reds' => 'nullable|array',
            'reds.*' => 'nullable|integer|min:0',
        ]);

        $images = $course->{$type . '_images'} ?? [];
        $uploadedImages = $request->file('images');
        $holes = $request->holes ?? [];
        $pars = $request->pars ?? [];
        $golds = $request->golds ?? [];
        $blues = $request->blues ?? [];
        $whites = $request->whites ?? [];
        $reds = $request->reds ?? [];

        foreach ($uploadedImages as $key => $image) {
            $images[] = [
                'image' => $image->store('images/courses/' . $type, 'public'),
                'hole' => $holes[$key] ?? 1,
                'par' => $pars[$key] ?? 4,
                'gold' => $golds[$key] ?? 0,
                'blue' => $blues[$key] ?? 0,
                'white' => $whites[$key] ?? 0,
                'red' => $reds[$key] ?? 0,
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

    private function processGallery($files, $holes, $pars, $golds, $blues, $whites, $reds, $storagePath)
    {
        $gallery = [];
        if ($files) {
            foreach ($files as $key => $file) {
                $gallery[] = [
                    'image' => $file->store($storagePath, 'public'),
                    'hole' => $holes[$key] ?? 1,
                    'par' => $pars[$key] ?? 4,
                    'gold' => $golds[$key] ?? 0,
                    'blue' => $blues[$key] ?? 0,
                    'white' => $whites[$key] ?? 0,
                    'red' => $reds[$key] ?? 0,
                ];
            }
        }
        return $gallery;
    }
}
