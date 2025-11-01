<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomepageContent;

class AdminHomepageController extends Controller
{
    /**
     * Show CMS page with existing homepage content or empty placeholders.
     */
    public function index()
    {
        $homepage = HomepageContent::first() ?? new HomepageContent();
        return view('admin.admin_homepage', compact('homepage'));
    }

    /**
     * Update or create homepage content.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'headline' => 'nullable|string|max:255',
            'subheadline' => 'nullable|string',
            'carousel1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'carousel2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'carousel3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'carousel4' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'carousel5' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'carousel1Caption' => 'nullable|string',
            'carousel2Caption' => 'nullable|string',
            'carousel3Caption' => 'nullable|string',
            'carousel4Caption' => 'nullable|string',
            'carousel5Caption' => 'nullable|string',
            'card1_title' => 'nullable|string|max:255',
            'card2_title' => 'nullable|string|max:255',
            'card3_title' => 'nullable|string|max:255',
            'card1_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'card2_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'card3_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'map_embed' => 'nullable|string',
        ]);

        $homepage = HomepageContent::firstOrNew(['id' => 1]);

        // handle image uploads
        foreach (['carousel1','carousel2','carousel3','carousel4','carousel5',
                  'card1_image','card2_image','card3_image'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('homepage', 'public');
            }
        }

        $homepage->fill($validated)->save();

        return back()->with('success', 'Homepage updated successfully!');
    }
}
