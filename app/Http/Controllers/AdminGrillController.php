<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GrillContent;
use Illuminate\Support\Facades\Storage;

class AdminGrillController extends Controller
{
    // show admin editor
    public function index()
    {
        $content = GrillContent::first();
        return view('admin.admin_grill', compact('content'));
    }

    // Upload one or more carousel images (append)
    public function uploadCarousel(Request $request)
    {
        $request->validate([
            'carousel_images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        $content = GrillContent::firstOrCreate([]);
        $images = $content->carousel_images ?? [];

        if ($request->hasFile('carousel_images')) {
            foreach ($request->file('carousel_images') as $file) {
                $path = $this->storeImage($file, 'grill/carousel');
                $images[] = $path;
            }
        }

        $content->carousel_images = $images;
        $content->save();

        return back()->with('modal_message', 'Carousel image uploaded successfully!');
    }

    // Update/replace carousel image at index
    public function updateCarousel(Request $request, $index)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        $content = GrillContent::firstOrCreate([]);
        $images = $content->carousel_images ?? [];

        if (!isset($images[$index])) {
            return back()->with('error', 'Carousel image not found.');
        }

        // delete old
        $this->deleteImageFile($images[$index]);

        $path = $this->storeImage($request->file('image'), 'grill/carousel');
        $images[$index] = $path;
        $content->carousel_images = $images;
        $content->save();

        return back()->with('modal_message', 'Carousel image updated successfully!');
    }

    // Remove carousel image
    public function removeCarousel(Request $request, $index)
    {
        $content = GrillContent::firstOrCreate([]);
        $images = $content->carousel_images ?? [];
        
        if (!isset($images[$index])) {
            $msg = 'Carousel image not found.';
            if ($request->expectsJson()) return response()->json(['success' => false, 'message' => $msg]);
            return back()->with('modal_message', $msg);
        }

        $this->deleteImageFile($images[$index]);

        array_splice($images, $index, 1);
        $content->carousel_images = $images;
        $content->save();

        $msg = 'Carousel image successfully removed.';
        if ($request->expectsJson()) return response()->json(['success' => true, 'message' => $msg]);
        return back()->with('modal_message', $msg);
    }

    // Add menu item (create with submitted values)
    public function addMenuItem(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:191',
            'price' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        $content = GrillContent::firstOrCreate([]);
        $items = $content->menu_items ?? [];

        // store image if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->storeImage($request->file('image'), 'grill/menu');
        }

        // Build the item (keep same structure you use elsewhere)
        $newItem = [
            'name'  => $request->input('name'),
            'price' => $request->input('price') ?? '',
            'image' => $imagePath ?? '',
        ];

        $items[] = $newItem;
        $content->menu_items = $items;
        $content->save();

        return back()->with('modal_message', 'Menu item added successfully!');
    }

    // Update menu item (replace image optional)
    public function updateMenuItem(Request $request, $index)
    {
        $request->validate([
            'name' => 'nullable|string|max:191',
            'price' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        $content = GrillContent::firstOrCreate([]);
        $items = $content->menu_items ?? [];

        if (!isset($items[$index])) {
            return back()->with('error', 'Menu item not found!');
        }

        $items[$index]['name'] = $request->input('name', $items[$index]['name'] ?? '');
        $items[$index]['price'] = $request->input('price', $items[$index]['price'] ?? '');

        if ($request->hasFile('image')) {
            // delete old
            $this->deleteImageFile($items[$index]['image']);
            
            $items[$index]['image'] = $this->storeImage($request->file('image'), 'grill/menu');
        }

        $content->menu_items = $items;
        $content->save();

        return back()->with('modal_message', 'Menu item updated successfully!');
    }

    // Remove menu item
    public function removeMenuItem(Request $request, $index)
    {
        $content = GrillContent::firstOrCreate([]);
        $menu = $content->menu_items ?? [];
        
        if (!isset($menu[$index])) {
            $msg = 'Menu item not found.';
            if ($request->expectsJson()) return response()->json(['success' => false, 'message' => $msg]);
            return back()->with('modal_message', $msg);
        }

        $this->deleteImageFile($menu[$index]['image'] ?? null);

        array_splice($menu, $index, 1);
        $content->menu_items = $menu;
        $content->save();

        $msg = 'Menu item successfully removed!';
        if ($request->expectsJson()) return response()->json(['success' => true, 'message' => $msg]);
        return back()->with('modal_message', $msg);
    }

    /**
     * Store image and return path with /storage/ prefix
     */
    private function storeImage($image, string $path): string
    {
        $storedPath = $image->store($path, 'public');
        return '/storage/' . $storedPath;
    }

    /**
     * Delete image file from storage
     */
    private function deleteImageFile(?string $imagePath): void
    {
        if (!$imagePath) {
            return;
        }

        // Remove /storage/ prefix to get disk path
        $diskPath = str_replace('/storage/', '', $imagePath);
        
        if (Storage::disk('public')->exists($diskPath)) {
            Storage::disk('public')->delete($diskPath);
        }
    }
}