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

    // Upload one or more carousel items (images or videos)
    public function uploadCarousel(Request $request)
    {
        $request->validate([
            'carousel_images.*' => 'required|file|mimes:jpg,jpeg,png,webp,mp4|max:51200', // 50MB max for videos
        ]);

        $content = GrillContent::firstOrCreate([]);
        $items = $content->carousel_images ?? [];

        if ($request->hasFile('carousel_images')) {
            foreach ($request->file('carousel_images') as $file) {
                // Determine file type
                $mimeType = $file->getMimeType();
                $type = str_starts_with($mimeType, 'video/') ? 'video' : 'image';
                
                // Store based on type
                if ($type === 'video') {
                    $path = $this->storeVideo($file, 'grill/carousel');
                } else {
                    $path = $this->storeImage($file, 'grill/carousel');
                }
                
                $items[] = [
                    'path' => $path,
                    'type' => $type,
                    'original_name' => $file->getClientOriginalName(),
                ];
            }
        }

        $content->carousel_images = $items;
        $content->save();

        return back()->with('modal_message', 'Carousel items uploaded successfully!');
    }

    // Update/replace carousel item at index
    public function updateCarousel(Request $request, $index)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png,webp,mp4|max:51200', // 50MB
        ]);

        $content = GrillContent::firstOrCreate([]);
        $items = $content->carousel_images ?? [];

        if (!isset($items[$index])) {
            return back()->with('error', 'Carousel item not found.');
        }

        // Handle old format (string) or new format (array)
        $oldItem = $items[$index];
        
        // Delete old file if it exists
        if (is_array($oldItem) && isset($oldItem['path'])) {
            $this->deleteFile($oldItem['path']);
        } elseif (is_string($oldItem)) {
            $this->deleteFile($oldItem);
        }

        // Determine file type
        $file = $request->file('image');
        $mimeType = $file->getMimeType();
        $type = str_starts_with($mimeType, 'video/') ? 'video' : 'image';
        
        // Store based on type
        if ($type === 'video') {
            $path = $this->storeVideo($file, 'grill/carousel');
        } else {
            $path = $this->storeImage($file, 'grill/carousel');
        }

        // Save in new format
        $items[$index] = [
            'path' => $path,
            'type' => $type,
            'original_name' => $file->getClientOriginalName(),
        ];
        
        $content->carousel_images = $items;
        $content->save();

        return back()->with('modal_message', 'Carousel item updated successfully!');
    }

    // Remove carousel item
    public function removeCarousel(Request $request, $index)
    {
        $content = GrillContent::firstOrCreate([]);
        $items = $content->carousel_images ?? [];
        
        if (!isset($items[$index])) {
            $msg = 'Carousel item not found.';
            if ($request->expectsJson()) return response()->json(['success' => false, 'message' => $msg]);
            return back()->with('modal_message', $msg);
        }

        // Handle old format (string) or new format (array)
        $item = $items[$index];
        if (is_array($item) && isset($item['path'])) {
            $this->deleteFile($item['path']);
        } elseif (is_string($item)) {
            $this->deleteFile($item);
        }

        array_splice($items, $index, 1);
        $content->carousel_images = $items;
        $content->save();

        $msg = 'Carousel item successfully removed.';
        if ($request->expectsJson()) return response()->json(['success' => true, 'message' => $msg]);
        return back()->with('modal_message', $msg);
    }

    // CATEGORY MANAGEMENT
    // Update the addCategory method:
public function addCategory(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'description' => 'nullable|string|max:500',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB
    ]);

    $content = GrillContent::firstOrCreate([]);
    $categories = $content->menu_categories ?? [];
    
    // Generate new ID
    $newId = 1;
    if (!empty($categories)) {
        $maxId = max(array_column($categories, 'id'));
        $newId = $maxId + 1;
    }
    
    // Store image if provided
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $this->storeImage($request->file('image'), 'grill/categories');
    }
    
    $categories[] = [
        'id' => $newId,
        'name' => $request->input('name'),
        'description' => $request->input('description', ''),
        'image' => $imagePath ?? '',
    ];
    
    $content->menu_categories = $categories;
    $content->save();

    return back()->with('modal_message', 'Category added successfully!');
}

// Update the updateCategory method:
public function updateCategory(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'description' => 'nullable|string|max:500',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
    ]);

    $content = GrillContent::firstOrCreate([]);
    $categories = $content->menu_categories ?? [];
    
    $found = false;
    foreach ($categories as &$category) {
        if ($category['id'] == $id) {
            $category['name'] = $request->input('name');
            $category['description'] = $request->input('description', '');
            
            // Update image if provided
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if (!empty($category['image'])) {
                    $this->deleteFile($category['image']);
                }
                $category['image'] = $this->storeImage($request->file('image'), 'grill/categories');
            }
            
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        return back()->with('error', 'Category not found.');
    }
    
    $content->menu_categories = $categories;
    $content->save();

    return back()->with('modal_message', 'Category updated successfully!');
}

// Update the removeCategory method to delete the image:
public function removeCategory(Request $request, $id)
{
    $content = GrillContent::firstOrCreate([]);
    $categories = $content->menu_categories ?? [];
    $menuItems = $content->menu_items ?? [];
    
    // Find category
    $categoryToDelete = null;
    $index = null;
    foreach ($categories as $i => $category) {
        if ($category['id'] == $id) {
            $categoryToDelete = $category;
            $index = $i;
            break;
        }
    }
    
    if ($index === null) {
        $msg = 'Category not found.';
        if ($request->expectsJson()) return response()->json(['success' => false, 'message' => $msg]);
        return back()->with('modal_message', $msg);
    }
    
    // Delete category image if exists
    if (!empty($categoryToDelete['image'])) {
        $this->deleteFile($categoryToDelete['image']);
    }
    
    // Remove category
    array_splice($categories, $index, 1);
    
    // Update menu items to remove category_id
    foreach ($menuItems as &$item) {
        if (isset($item['category_id']) && $item['category_id'] == $id) {
            $item['category_id'] = null;
        }
    }
    
    $content->menu_categories = $categories;
    $content->menu_items = $menuItems;
    $content->save();

    $msg = 'Category removed successfully!';
    if ($request->expectsJson()) return response()->json(['success' => true, 'message' => $msg]);
    return back()->with('modal_message', $msg);
}

    // Add menu item with category selection
    public function addMenuItem(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:191',
            'price' => 'nullable|string|max:50',
            'category_id' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        $content = GrillContent::firstOrCreate([]);
        $items = $content->menu_items ?? [];

        // store image if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->storeImage($request->file('image'), 'grill/menu');
        }

        // Validate category exists
        $categoryId = $request->input('category_id');
        if ($categoryId) {
            $categories = $content->menu_categories ?? [];
            $categoryExists = collect($categories)->contains('id', $categoryId);
            if (!$categoryExists) {
                $categoryId = null;
            }
        }

        // Build the item (keep same structure you use elsewhere)
        $newItem = [
            'name'  => $request->input('name'),
            'price' => $request->input('price') ?? '',
            'image' => $imagePath ?? '',
            'category_id' => $categoryId,
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
            'category_id' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB = 5120KB
        ]);

        $content = GrillContent::firstOrCreate([]);
        $items = $content->menu_items ?? [];

        if (!isset($items[$index])) {
            return back()->with('error', 'Menu item not found!');
        }

        $items[$index]['name'] = $request->input('name', $items[$index]['name'] ?? '');
        $items[$index]['price'] = $request->input('price', $items[$index]['price'] ?? '');
        
        // Validate and update category
        $categoryId = $request->input('category_id');
        if ($categoryId) {
            $categories = $content->menu_categories ?? [];
            $categoryExists = collect($categories)->contains('id', $categoryId);
            if ($categoryExists) {
                $items[$index]['category_id'] = $categoryId;
            }
        } else {
            $items[$index]['category_id'] = null;
        }

        if ($request->hasFile('image')) {
            // delete old
            $this->deleteFile($items[$index]['image']);
            
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

        $this->deleteFile($menu[$index]['image'] ?? null);

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
     * Store video and return path with /storage/ prefix
     */
    private function storeVideo($video, string $path): string
    {
        $storedPath = $video->store($path, 'public');
        return '/storage/' . $storedPath;
    }

    /**
     * Delete file from storage
     */
    private function deleteFile(?string $filePath): void
    {
        if (!$filePath) {
            return;
        }

        // Remove /storage/ prefix to get disk path
        $diskPath = str_replace('/storage/', '', $filePath);
        
        if (Storage::disk('public')->exists($diskPath)) {
            Storage::disk('public')->delete($diskPath);
        }
    }
}