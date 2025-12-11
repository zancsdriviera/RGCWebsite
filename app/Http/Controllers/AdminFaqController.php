<?php

namespace App\Http\Controllers;

use App\Models\FaqContent;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    public function show()
    {
        $faqs = FaqContent::orderBy('category')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $categories = FaqContent::getExistingCategories();
        
        return view('admin.admin_faq', compact('faqs', 'categories'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:100',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('faq-icons', 'public');
            $iconPath = basename($iconPath); // Store just filename
        }

        FaqContent::create([
            'category' => $validated['category'],
            'icon' => $iconPath,
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'is_active' => $request->has('is_active')
        ]);

        return back()->with('success', 'FAQ created successfully.');
    }

    public function update(Request $request, $id)
    {
        $faq = FaqContent::findOrFail($id);
        
        $validated = $request->validate([
            'category' => 'required|string|max:100',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        // Handle icon update
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($faq->icon) {
                Storage::disk('public')->delete('faq-icons/' . $faq->icon);
            }
            
            $iconPath = $request->file('icon')->store('faq-icons', 'public');
            $iconPath = basename($iconPath);
        } else {
            $iconPath = $faq->icon; // Keep existing
        }

        $faq->update([
            'category' => $validated['category'],
            'icon' => $iconPath,
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'is_active' => $request->has('is_active')
        ]);

        return back()->with('success', 'FAQ updated successfully.');
    }

    public function delete($id)
    {
        $faq = FaqContent::findOrFail($id);
        
        // Delete icon file if exists
        if ($faq->icon) {
            Storage::disk('public')->delete('faq-icons/' . $faq->icon);
        }
        
        $faq->delete();
        
        return back()->with('success', 'FAQ deleted successfully.');
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