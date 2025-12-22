<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\AboutUsContent;
use Illuminate\Support\Facades\Validator;

class AdminAboutUsController extends Controller
{
    // Show About Us edit page
    public function index()
    {
        $aboutUsContent = AboutUsContent::first();
        return view('admin.admin_about_us', compact('aboutUsContent'));
    }

    // Generic update for Mission, Vision, Facilities caption/image
    public function update(Request $request, $section)
    {
        $aboutUsContent = AboutUsContent::first();

        if (!$aboutUsContent) {
            $aboutUsContent = new AboutUsContent();
        }

        switch ($section) {
            case 'mission':
                $request->validate([
                    'mission_title' => 'required|string|max:255',
                    'mission_text' => 'required|string',
                    'mission_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240', // 10MB
                ]);
                
                $aboutUsContent->mission_title = $request->mission_title;
                $aboutUsContent->mission_text = $request->mission_text;
                if ($request->hasFile('mission_image')) {
                    $aboutUsContent->mission_image = $request->file('mission_image')->store('about_us', 'public');
                }
                break;

            case 'vision':
                $request->validate([
                    'vision_title' => 'required|string|max:255',
                    'vision_text' => 'required|string',
                    'vision_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240', // 10MB
                ]);
                
                $aboutUsContent->vision_title = $request->vision_title;
                $aboutUsContent->vision_text = $request->vision_text;
                if ($request->hasFile('vision_image')) {
                    $aboutUsContent->vision_image = $request->file('vision_image')->store('about_us', 'public');
                }
                break;

            case 'facilities':
                $request->validate([
                    'facilities_caption' => 'required|string',
                    'facilities_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240', // 10MB
                ]);
                
                if ($request->has('facilities_caption')) {
                    $aboutUsContent->facilities_caption = $request->facilities_caption;
                }
                if ($request->hasFile('facilities_image')) {
                    $aboutUsContent->facilities_image = $request->file('facilities_image')->store('about_us', 'public');
                }
                break;

            case 'boards':
                if ($request->has('board_year')) {
                    $aboutUsContent->board_year = $request->board_year;
                }
                break;
        }

        $aboutUsContent->save();
        return redirect()->back()
            ->with('modal_message', ucfirst($section) . ' content updated!')
            ->with('show_modal', true);
    }

    // ================= BOARD OF DIRECTORS =================
    public function addBoard(Request $request)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $boards = $aboutUsContent->boards ?? [];
        $boards[] = ['name' => '', 'position' => '', 'image' => ''];
        $aboutUsContent->boards = $boards;
        $aboutUsContent->save();

        $newIndex = count($boards) - 1;

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'index' => $newIndex]);
        }

        return redirect()->back();
    }

    public function updateBoard(Request $request, $index)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240', // 10MB
        ]);

        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $boards = $aboutUsContent->boards ?? [];

        if (!isset($boards[$index])) {
            return response()->json([
                'success' => false,
                'message' => 'Board member not found.'
            ], 404);
        }

        $boards[$index]['name'] = $request->name;
        $boards[$index]['position'] = $request->position;

        if ($request->hasFile('image')) {
            if (!empty($boards[$index]['image']) && \Storage::disk('public')->exists($boards[$index]['image'])) {
                \Storage::disk('public')->delete($boards[$index]['image']);
            }
            $boards[$index]['image'] = $request->file('image')->store('about_us', 'public');
        }

        $aboutUsContent->boards = $boards;
        $aboutUsContent->save();

        return response()->json([
            'success' => true,
            'board' => $boards[$index],
        ]);
    }

    public function removeBoard(Request $request, $index)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $boards = $aboutUsContent->boards ?? [];

        if (isset($boards[$index])) {
            // delete stored image file if exists
            if (!empty($boards[$index]['image']) && \Storage::disk('public')->exists($boards[$index]['image'])) {
                \Storage::disk('public')->delete($boards[$index]['image']);
            }
            array_splice($boards, $index, 1);
            $aboutUsContent->boards = $boards;
            $aboutUsContent->save();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true]);
            }
        } else {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Index not found.'], 404);
            }
        }

        return redirect()->back();
    }

   // ================= FACILITIES BULLETS =================
    public function addBullet(Request $request)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $bullets = $aboutUsContent->facilities_bullets ?? [];
        $bullets[] = '';
        $aboutUsContent->facilities_bullets = $bullets;
        $aboutUsContent->save();

        $newIndex = count($bullets) - 1;

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'index' => $newIndex]);
        }

        return redirect()->back();
    }

    public function updateBullet(Request $request, $index)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $bullets = $aboutUsContent->facilities_bullets ?? [];

        $action = $request->input('action', 'save');

        if ($action === 'remove') {
            if (isset($bullets[$index])) {
                array_splice($bullets, $index, 1);
                $aboutUsContent->facilities_bullets = $bullets;
                $aboutUsContent->save();

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => true]);
                }
                return redirect()->back()->with('success', 'Bullet removed.');
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Bullet not found.'], 404);
            }
            return redirect()->back()->with('error', 'Bullet not found.');
        }

        // save/update
        $request->validate(['bullet' => 'required|string|max:255']);

        if (!isset($bullets[$index])) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Bullet not found.'], 404);
            }
            return redirect()->back()->with('error', 'Bullet not found.');
        }

        $bullets[$index] = $request->input('bullet');
        $aboutUsContent->facilities_bullets = $bullets;
        $aboutUsContent->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'index' => $index, 'bullet' => $bullets[$index]]);
        }

        return redirect()->back()->with('success', 'Bullet content updated.');
    }

    public function removeBullet(Request $request, $index)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $bullets = $aboutUsContent->facilities_bullets ?? [];
        if (isset($bullets[$index])) {
            array_splice($bullets, $index, 1);
            $aboutUsContent->facilities_bullets = $bullets;
            $aboutUsContent->save();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true]);
            }
        } else {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Index not found.'], 404);
            }
        }

        return redirect()->back();
    }

    // ================= VALUES / CORE PRINCIPLES =================
    public function addValue(Request $request)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $values = $aboutUsContent->values ?? [];
        $values[] = ['title' => '', 'description' => '', 'icon' => ''];
        $aboutUsContent->values = $values;
        $aboutUsContent->save();

        $newIndex = count($values) - 1;

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'index' => $newIndex]);
        }

        return redirect()->back();
    }

    public function updateValue(Request $request, $index)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240' // 10MB
        ]);

        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $values = $aboutUsContent->values ?? [];

        if (!isset($values[$index])) {
            return response()->json(['success' => false, 'message' => 'Value not found.'], 404);
        }

        $values[$index]['title'] = $request->title;
        $values[$index]['description'] = $request->description;

        if ($request->hasFile('icon')) {
            if (!empty($values[$index]['icon']) &&
                \Storage::disk('public')->exists($values[$index]['icon'])) {
                \Storage::disk('public')->delete($values[$index]['icon']);
            }

            $values[$index]['icon'] = $request->file('icon')->store('about_us', 'public');
        }

        $aboutUsContent->values = $values;
        $aboutUsContent->save();

        return response()->json([
            'success' => true,
            'value' => $values[$index]
        ]);
    }

    // Remove a value
    public function removeValue(Request $request, $index)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $values = $aboutUsContent->values ?? [];

        if (!isset($values[$index])) {
            return response()->json(['success' => false, 'message' => 'Value not found.'], 404);
        }

        // delete icon if exists
        if (!empty($values[$index]['icon']) && \Storage::disk('public')->exists($values[$index]['icon'])) {
            \Storage::disk('public')->delete($values[$index]['icon']);
        }

        array_splice($values, $index, 1);
        $aboutUsContent->values = $values;
        $aboutUsContent->save();

        return response()->json(['success' => true]);
    }
}