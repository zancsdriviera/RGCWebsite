<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminAnnouncementController extends Controller
{
    public function index()
    {
        $announcements = AnnouncementContent::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.admin_announcement', compact('announcements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_published' => 'boolean',
            'published_date' => 'nullable|date',
            'order' => 'integer'
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $count = 1;
        while (AnnouncementContent::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $validated['slug'] = $slug;

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('announcements', 'public');
            $validated['featured_image'] = $path;
        }

        AnnouncementContent::create($validated);

        return redirect()->route('admin.announcement.index')
            ->with('success', 'Announcement created successfully!');
    }

    public function update(Request $request, $id)
    {
        $announcement = AnnouncementContent::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_published' => 'boolean',
            'published_date' => 'nullable|date',
            'order' => 'integer'
        ]);

        if ($announcement->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $originalSlug = $slug;
            $count = 1;
            while (AnnouncementContent::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('featured_image')) {
            if ($announcement->featured_image && Storage::disk('public')->exists($announcement->featured_image)) {
                Storage::disk('public')->delete($announcement->featured_image);
            }
            $path = $request->file('featured_image')->store('announcements', 'public');
            $validated['featured_image'] = $path;
        }

        $announcement->update($validated);

        return redirect()->route('admin.announcement.index')
            ->with('success', 'Announcement updated successfully!');
    }

    public function destroy($id)
    {
        $announcement = AnnouncementContent::findOrFail($id);
        
        if ($announcement->featured_image && Storage::disk('public')->exists($announcement->featured_image)) {
            Storage::disk('public')->delete($announcement->featured_image);
        }
        
        $announcement->delete();

        return redirect()->route('admin.announcement.index')
            ->with('success', 'Announcement deleted successfully!');
    }

    public function updateOrder(Request $request, $id)
    {
        $announcement = AnnouncementContent::findOrFail($id);
        $announcement->update(['order' => $request->order]);
        
        return response()->json(['success' => true]);
    }
}