<?php

namespace App\Http\Controllers;

use App\Models\FaqContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFaqController extends Controller
{
    public function show()
    {
        $faqs = FaqContent::orderBy('type')
            ->orderBy('category')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $categories = FaqContent::getExistingCategories();
        
        return view('admin.admin_faq', compact('faqs', 'categories'));
    }

    public function create(Request $request)
    {
        $type = $request->input('type', 'qa');
        
        if ($type === 'qa') {
            $validated = $request->validate([
                'type' => 'required|in:qa,qr',
                'category' => 'required|string|max:100',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'question' => 'required|string|max:255',
                'answer' => 'required|string',
            ]);
        } else {
            $validated = $request->validate([
                'type' => 'required|in:qa,qr',
                'faq_title' => 'required|string|max:100',
                'faq_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                // REMOVED: 'faq_icon_class' validation
            ]);
        }

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconFile = $request->file('icon');
            $iconName = time() . '_' . uniqid() . '.' . $iconFile->getClientOriginalExtension();
            Storage::disk('public')->put('faqicons/' . $iconName, file_get_contents($iconFile));
            $iconPath = $iconName;
        }

        $faqImagePath = null;
        if ($request->hasFile('faq_image')) {
            $imageFile = $request->file('faq_image');
            $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            Storage::disk('public')->put('FAQ/' . $imageName, file_get_contents($imageFile));
            $faqImagePath = $imageName;
        }

        $data = [
            'type' => $type,
            'is_active' => $request->has('is_active')
        ];

        if ($type === 'qa') {
            $data = array_merge($data, [
                'category' => $validated['category'],
                'icon' => $iconPath,
                'question' => $validated['question'],
                'answer' => $validated['answer'],
            ]);
        } else {
            $data = array_merge($data, [
                'faq_title' => $validated['faq_title'],
                'faq_image' => $faqImagePath,
                // REMOVED: 'faq_icon_class'
                'category' => 'QR Feedback',
                'question' => 'QR Feedback Item',
                'answer' => 'Scan QR code to provide feedback',
            ]);
        }

        FaqContent::create($data);

        return back()->with('success', ucfirst($type) . ' item created successfully.');
    }

    public function update(Request $request, $id)
    {
        $faq = FaqContent::findOrFail($id);
        $type = $faq->type;
        
        if ($type === 'qa') {
            $validated = $request->validate([
                'category' => 'required|string|max:100',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'question' => 'required|string|max:255',
                'answer' => 'required|string',
            ]);
        } else {
            $validated = $request->validate([
                'faq_title' => 'required|string|max:100',
                'faq_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                // REMOVED: 'faq_icon_class' validation
            ]);
        }

        // Handle icon update (for Q&A)
        if ($type === 'qa' && $request->hasFile('icon')) {
            if ($faq->icon) {
                Storage::disk('public')->delete('faqicons/' . $faq->icon);
            }
            
            $iconFile = $request->file('icon');
            $iconName = time() . '_' . uniqid() . '.' . $iconFile->getClientOriginalExtension();
            Storage::disk('public')->put('faqicons/' . $iconName, file_get_contents($iconFile));
            $iconPath = $iconName;
        } else {
            $iconPath = $faq->icon;
        }

        // Handle faq_image update (for QR)
        if ($type === 'qr' && $request->hasFile('faq_image')) {
            if ($faq->faq_image) {
                Storage::disk('public')->delete('FAQ/' . $faq->faq_image);
            }
            
            $imageFile = $request->file('faq_image');
            $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            Storage::disk('public')->put('FAQ/' . $imageName, file_get_contents($imageFile));
            $faqImagePath = $imageName;
        } else {
            $faqImagePath = $faq->faq_image;
        }

        $data = [
            'is_active' => $request->has('is_active')
        ];

        if ($type === 'qa') {
            $data = array_merge($data, [
                'category' => $validated['category'],
                'icon' => $iconPath,
                'question' => $validated['question'],
                'answer' => $validated['answer'],
            ]);
        } else {
            $data = array_merge($data, [
                'faq_title' => $validated['faq_title'],
                'faq_image' => $faqImagePath,
                // REMOVED: 'faq_icon_class' update
            ]);
        }

        $faq->update($data);

        return back()->with('success', ucfirst($type) . ' item updated successfully.');
    }

    public function delete($id)
    {
        $faq = FaqContent::findOrFail($id);
        
        if ($faq->icon) {
            Storage::disk('public')->delete('faqicons/' . $faq->icon);
        }
        
        if ($faq->faq_image) {
            Storage::disk('public')->delete('FAQ/' . $faq->faq_image);
        }
        
        $faq->delete();
        
        return back()->with('success', 'Item deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $faq = FaqContent::findOrFail($id);
        $faq->update(['is_active' => !$faq->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $faq->is_active
        ]);
    }
}