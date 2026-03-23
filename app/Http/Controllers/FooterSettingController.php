<?php

namespace App\Http\Controllers;

use App\Models\FooterSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterSettingController extends Controller
{
    public function index()
    {
        $footerSetting = FooterSetting::first();
        return view('admin.footer-settings', compact('footerSetting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'phone_number' => 'nullable|string|max:20',
            'location_url' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:500',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'copyright_text' => 'nullable|string|max:100',
            'club_name' => 'nullable|string|max:100'
        ]);

        $footerSetting = FooterSetting::firstOrNew();
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($footerSetting->logo_path && Storage::disk('public')->exists($footerSetting->logo_path)) {
                Storage::disk('public')->delete($footerSetting->logo_path);
            }
            
            $path = $request->file('logo')->store('footer', 'public');
            $validated['logo_path'] = $path;
        }
        
        $footerSetting->fill($validated);
        $footerSetting->save();
        
        return redirect()->route('admin.footer-settings')
            ->with('success', 'Footer settings updated successfully!');
    }
}