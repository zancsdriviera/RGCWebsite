<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\GrillContent;

class AdminGrillController extends Controller
{
    public function index()
    {
        $content = GrillContent::firstOrCreate([]);
        return view('admin.admin_grill', compact('content'));
    }

    /* ===================== CAROUSEL ===================== */
    public function uploadCarousel(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120'
        ]);

        $content = GrillContent::firstOrCreate([]);
        $carousel = $content->carousel ?? [];

        $path = $request->file('image')->store('grill/carousel', 'public');
        $carousel[] = '/storage/' . $path;

        $content->carousel = $carousel;
        $content->save();

        return back()->with('modal_message', 'Carousel image added!');
    }

    public function updateCarousel(Request $request, $index)
    {
        $request->validate(['image' => 'required|image|max:5120']);

        $content = GrillContent::firstOrCreate([]);
        $carousel = $content->carousel ?? [];

        if (!isset($carousel[$index])) return back();

        $this->deleteFile($carousel[$index]);
        $carousel[$index] = '/storage/' . $request->file('image')->store('grill/carousel', 'public');

        $content->carousel = $carousel;
        $content->save();

        return back()->with('modal_message', 'Carousel updated!');
    }

    public function removeCarousel($index)
    {
        $content = GrillContent::firstOrCreate([]);
        $carousel = $content->carousel ?? [];

        if (!isset($carousel[$index])) return back();

        $this->deleteFile($carousel[$index]);
        array_splice($carousel, $index, 1);

        $content->carousel = $carousel;
        $content->save();

        return back()->with('modal_message', 'Carousel removed!');
    }

    /* ===================== MENU ITEMS ===================== */
    public function addMenuItem(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|max:5120'
        ]);

        $content = GrillContent::firstOrCreate([]);
        $items = $content->menu_items ?? [];

        $image = $request->hasFile('image')
            ? '/storage/' . $request->file('image')->store('grill/menu', 'public')
            : null;

        $items[] = [
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $image
        ];

        $content->menu_items = $items;
        $content->save();

        return back()->with('modal_message', 'Menu item added!');
    }

    public function updateMenuItem(Request $request, $index)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $content = GrillContent::firstOrCreate([]);
        $items = $content->menu_items ?? [];

        if (!isset($items[$index])) return back();

        $items[$index]['name'] = $request->name;
        $items[$index]['price'] = $request->price;

        if ($request->hasFile('image')) {
            $this->deleteFile($items[$index]['image']);
            $items[$index]['image'] =
                '/storage/' . $request->file('image')->store('grill/menu', 'public');
        }

        $content->menu_items = $items;
        $content->save();

        return back()->with('modal_message', 'Menu item updated!');
    }

    public function removeMenuItem($index)
    {
        $content = GrillContent::firstOrCreate([]);
        $items = $content->menu_items ?? [];

        if (!isset($items[$index])) return back();

        $this->deleteFile($items[$index]['image']);
        array_splice($items, $index, 1);

        $content->menu_items = $items;
        $content->save();

        return back()->with('modal_message', 'Menu item removed!');
    }

    /* ===================== 4 GRID IMAGES ===================== */
    public function addGalleryImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120'
        ]);

        $content = GrillContent::firstOrCreate([]);
        $gallery = $content->gallery_images ?? [];

        if (count($gallery) >= 4) {
            return back()->with('error', 'Only 4 images allowed.');
        }

        $path = $request->file('image')->store('grill/gallery', 'public');
        $gallery[] = $path;

        $content->gallery_images = $gallery;
        $content->save();

        return back()->with('modal_message', 'Gallery image added!');
    }

    public function updateGalleryImage(Request $request, $index)
    {
        $request->validate([
            'image' => 'required|image|max:5120'
        ]);

        $content = GrillContent::firstOrCreate([]);
        $gallery = $content->gallery_images ?? [];

        if (!isset($gallery[$index])) {
            return back()->with('error', 'Image not found.');
        }

        Storage::disk('public')->delete($gallery[$index]);

        $gallery[$index] = $request->file('image')
            ->store('grill/gallery', 'public');

        $content->gallery_images = $gallery;
        $content->save();

        return back()->with('modal_message', 'Gallery image updated!');
    }

    public function deleteGalleryImage($index)
    {
        $content = GrillContent::firstOrCreate([]);
        $gallery = $content->gallery_images ?? [];

        if (!isset($gallery[$index])) {
            return back()->with('error', 'Image not found.');
        }

        Storage::disk('public')->delete($gallery[$index]);
        array_splice($gallery, $index, 1);

        $content->gallery_images = $gallery;
        $content->save();

        return back()->with('modal_message', 'Gallery image deleted!');
    }

    /* ===================== HELPERS ===================== */
    private function deleteFile(?string $path)
    {
        if (!$path) return;

        $path = str_replace('/storage/', '', $path);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
