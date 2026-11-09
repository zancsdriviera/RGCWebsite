<?php

namespace App\Http\Controllers;

use App\Models\AboutUsContent;
use App\Services\ImageKitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminAboutUsController extends Controller
{
    // =========================================================
    // IMAGE STORAGE HELPERS
    // =========================================================

    /**
     * Upload an image to ImageKit and return its URL.
     */
    private function uploadImage($file, string $folder = 'about_us'): string
    {
        $uploadedImage = app(ImageKitService::class)->upload($file, $folder);

        return $uploadedImage['url'];
    }

    /**
     * Check whether an image path is an external URL.
     */
    private function isRemoteImage(?string $imagePath): bool
    {
        return !empty($imagePath)
            && Str::startsWith($imagePath, ['http://', 'https://']);
    }

    /**
     * Delete an old image only if it exists on local storage.
     *
     * ImageKit URLs are deliberately skipped because the current
     * database structure does not store ImageKit file IDs.
     */
    private function deleteLocalImage(?string $imagePath): void
    {
        if (
            !empty($imagePath) &&
            !$this->isRemoteImage($imagePath) &&
            Storage::disk('public')->exists($imagePath)
        ) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    // =========================================================
    // SHOW ABOUT US ADMIN PAGE
    // =========================================================

    public function index()
    {
        $aboutUsContent = AboutUsContent::first();

        return view('admin.admin_about_us', compact('aboutUsContent'));
    }

    // =========================================================
    // MISSION, VISION, FACILITIES, AND BOARD YEAR
    // =========================================================

    public function update(Request $request, $section)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);

        $oldImage = null;
        $imageField = null;

        switch ($section) {

            // ---------------- MISSION ----------------

            case 'mission':

                $request->validate([
                    'mission_title' => 'required|string|max:255',
                    'mission_text' => 'required|string',
                    'mission_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
                ]);

                $aboutUsContent->mission_title = $request->mission_title;
                $aboutUsContent->mission_text = $request->mission_text;

                if ($request->hasFile('mission_image')) {
                    $imageField = 'mission_image';
                    $oldImage = $aboutUsContent->mission_image;

                    $aboutUsContent->mission_image = $this->uploadImage(
                        $request->file('mission_image')
                    );
                }

                break;

            // ---------------- VISION ----------------

            case 'vision':

                $request->validate([
                    'vision_title' => 'required|string|max:255',
                    'vision_text' => 'required|string',
                    'vision_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
                ]);

                $aboutUsContent->vision_title = $request->vision_title;
                $aboutUsContent->vision_text = $request->vision_text;

                if ($request->hasFile('vision_image')) {
                    $imageField = 'vision_image';
                    $oldImage = $aboutUsContent->vision_image;

                    $aboutUsContent->vision_image = $this->uploadImage(
                        $request->file('vision_image')
                    );
                }

                break;

            // ---------------- FACILITIES ----------------

            case 'facilities':

                $request->validate([
                    'facilities_caption' => 'required|string',
                    'facilities_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
                ]);

                if ($request->has('facilities_caption')) {
                    $aboutUsContent->facilities_caption = $request->facilities_caption;
                }

                if ($request->hasFile('facilities_image')) {
                    $imageField = 'facilities_image';
                    $oldImage = $aboutUsContent->facilities_image;

                    $aboutUsContent->facilities_image = $this->uploadImage(
                        $request->file('facilities_image')
                    );
                }

                break;

            // ---------------- BOARD YEAR ----------------

            case 'boards':

                if ($request->has('board_year')) {
                    $aboutUsContent->board_year = $request->board_year;
                }

                break;

            default:

                abort(404, 'Invalid About Us section.');
        }

        // Save the new database value before deleting the old local file.
        $aboutUsContent->save();

        if ($imageField && $oldImage) {
            $this->deleteLocalImage($oldImage);
        }

        return redirect()->back()
            ->with('modal_message', ucfirst($section) . ' content updated!')
            ->with('show_modal', true);
    }

    // =========================================================
    // BOARD OF DIRECTORS
    // =========================================================

    public function addBoard(Request $request)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $boards = $aboutUsContent->boards ?? [];

        $boards[] = [
            'name' => '',
            'position' => '',
            'image' => '',
        ];

        $aboutUsContent->boards = $boards;
        $aboutUsContent->save();

        $newIndex = count($boards) - 1;

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'index' => $newIndex,
            ]);
        }

        return redirect()->back();
    }

    public function updateBoard(Request $request, $index)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $boards = $aboutUsContent->boards ?? [];

        if (!isset($boards[$index])) {
            return response()->json([
                'success' => false,
                'message' => 'Board member not found.',
            ], 404);
        }

        $boards[$index]['name'] = $request->name;
        $boards[$index]['position'] = $request->position;

        $oldImage = null;

        if ($request->hasFile('image')) {
            $oldImage = $boards[$index]['image'] ?? null;

            $boards[$index]['image'] = $this->uploadImage(
                $request->file('image')
            );
        }

        $aboutUsContent->boards = $boards;
        $aboutUsContent->save();

        if ($oldImage) {
            $this->deleteLocalImage($oldImage);
        }

        return response()->json([
            'success' => true,
            'board' => $boards[$index],
        ]);
    }

    public function removeBoard(Request $request, $index)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $boards = $aboutUsContent->boards ?? [];

        if (!isset($boards[$index])) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Index not found.',
                ], 404);
            }

            return redirect()->back();
        }

        $oldImage = $boards[$index]['image'] ?? null;

        array_splice($boards, $index, 1);

        $aboutUsContent->boards = $boards;
        $aboutUsContent->save();

        $this->deleteLocalImage($oldImage);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back();
    }

    // =========================================================
    // OFFICERS
    // =========================================================

    public function addOfficer(Request $request)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $officers = $aboutUsContent->officers ?? [];

        $officers[] = [
            'name' => '',
            'position' => '',
            'image' => '',
        ];

        $aboutUsContent->officers = $officers;
        $aboutUsContent->save();

        $newIndex = count($officers) - 1;

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'index' => $newIndex,
            ]);
        }

        return redirect()->back();
    }

    public function updateOfficer(Request $request, $index)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $officers = $aboutUsContent->officers ?? [];

        if (!isset($officers[$index])) {
            return response()->json([
                'success' => false,
                'message' => 'Officer not found.',
            ], 404);
        }

        $officers[$index]['name'] = $request->name;
        $officers[$index]['position'] = $request->position;

        $oldImage = null;

        if ($request->hasFile('image')) {
            $oldImage = $officers[$index]['image'] ?? null;

            $officers[$index]['image'] = $this->uploadImage(
                $request->file('image')
            );
        }

        $aboutUsContent->officers = $officers;
        $aboutUsContent->save();

        if ($oldImage) {
            $this->deleteLocalImage($oldImage);
        }

        return response()->json([
            'success' => true,
            'officer' => $officers[$index],
        ]);
    }

    public function removeOfficer(Request $request, $index)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $officers = $aboutUsContent->officers ?? [];

        if (!isset($officers[$index])) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Index not found.',
                ], 404);
            }

            return redirect()->back();
        }

        $oldImage = $officers[$index]['image'] ?? null;

        array_splice($officers, $index, 1);

        $aboutUsContent->officers = $officers;
        $aboutUsContent->save();

        $this->deleteLocalImage($oldImage);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back();
    }

    // =========================================================
    // FACILITIES BULLETS
    // =========================================================

    public function addBullet(Request $request)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $bullets = $aboutUsContent->facilities_bullets ?? [];

        $bullets[] = '';

        $aboutUsContent->facilities_bullets = $bullets;
        $aboutUsContent->save();

        $newIndex = count($bullets) - 1;

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'index' => $newIndex,
            ]);
        }

        return redirect()->back();
    }

    public function updateBullet(Request $request, $index)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $bullets = $aboutUsContent->facilities_bullets ?? [];

        $action = $request->input('action', 'save');

        // ---------------- REMOVE BULLET ----------------

        if ($action === 'remove') {
            if (!isset($bullets[$index])) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Bullet not found.',
                    ], 404);
                }

                return redirect()->back()->with('error', 'Bullet not found.');
            }

            array_splice($bullets, $index, 1);

            $aboutUsContent->facilities_bullets = $bullets;
            $aboutUsContent->save();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'Bullet removed.');
        }

        // ---------------- SAVE BULLET ----------------

        $request->validate([
            'bullet' => 'required|string|max:255',
        ]);

        if (!isset($bullets[$index])) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bullet not found.',
                ], 404);
            }

            return redirect()->back()->with('error', 'Bullet not found.');
        }

        $bullets[$index] = $request->input('bullet');

        $aboutUsContent->facilities_bullets = $bullets;
        $aboutUsContent->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'index' => $index,
                'bullet' => $bullets[$index],
            ]);
        }

        return redirect()->back()->with('success', 'Bullet content updated.');
    }

    public function removeBullet(Request $request, $index)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $bullets = $aboutUsContent->facilities_bullets ?? [];

        if (!isset($bullets[$index])) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Index not found.',
                ], 404);
            }

            return redirect()->back();
        }

        array_splice($bullets, $index, 1);

        $aboutUsContent->facilities_bullets = $bullets;
        $aboutUsContent->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back();
    }

    // =========================================================
    // VALUES / CORE PRINCIPLES
    // =========================================================

    public function addValue(Request $request)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $values = $aboutUsContent->values ?? [];

        $values[] = [
            'title' => '',
            'description' => '',
            'icon' => '',
        ];

        $aboutUsContent->values = $values;
        $aboutUsContent->save();

        $newIndex = count($values) - 1;

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'index' => $newIndex,
            ]);
        }

        return redirect()->back();
    }

    public function updateValue(Request $request, $index)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $values = $aboutUsContent->values ?? [];

        if (!isset($values[$index])) {
            return response()->json([
                'success' => false,
                'message' => 'Value not found.',
            ], 404);
        }

        $values[$index]['title'] = $request->title;
        $values[$index]['description'] = $request->description;

        $oldImage = null;

        if ($request->hasFile('icon')) {
            $oldImage = $values[$index]['icon'] ?? null;

            $values[$index]['icon'] = $this->uploadImage(
                $request->file('icon')
            );
        }

        $aboutUsContent->values = $values;
        $aboutUsContent->save();

        if ($oldImage) {
            $this->deleteLocalImage($oldImage);
        }

        return response()->json([
            'success' => true,
            'value' => $values[$index],
        ]);
    }

    public function removeValue(Request $request, $index)
    {
        $aboutUsContent = AboutUsContent::firstOrCreate([]);
        $values = $aboutUsContent->values ?? [];

        if (!isset($values[$index])) {
            return response()->json([
                'success' => false,
                'message' => 'Value not found.',
            ], 404);
        }

        $oldImage = $values[$index]['icon'] ?? null;

        array_splice($values, $index, 1);

        $aboutUsContent->values = $values;
        $aboutUsContent->save();

        $this->deleteLocalImage($oldImage);

        return response()->json(['success' => true]);
    }
}
