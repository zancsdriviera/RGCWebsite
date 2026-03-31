<?php

namespace App\Http\Controllers;

use App\Models\MenuSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuSettingController extends Controller
{
    public function index()
{
    // Exclude 'config' type from the menus list if you don't want to edit header settings in the menu table
    $menus = MenuSetting::where('menu_type', '!=', 'config')
        ->orderBy('menu_type')
        ->orderBy('order')
        ->get();
    
    $dropdownParents = MenuSetting::where('menu_type', 'dropdown_parent')->get();
    
    return view('admin.menu-settings', compact('menus', 'dropdownParents'));
}

    // Separate method for updating header settings
    public function updateHeader(Request $request)
    {
        $validated = $request->validate([
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:10240',
            'brand_text' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:20',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255'
        ]);

        // Get the header settings record
        $headerSettings = MenuSetting::getHeaderSettings();

        // Handle logo upload
        if ($request->hasFile('header_logo')) {
            // Delete old logo if exists
            if ($headerSettings->header_logo_path && Storage::disk('public')->exists($headerSettings->header_logo_path)) {
                Storage::disk('public')->delete($headerSettings->header_logo_path);
            }
            
            $path = $request->file('header_logo')->store('header', 'public');
            $headerSettings->header_logo_path = $path;
        }
        
        // Update brand text
        if ($request->has('brand_text')) {
            $headerSettings->brand_text = $request->brand_text;
        }
        
        // Update contact fields
        if ($request->has('phone_number')) {
            $headerSettings->phone_number = $request->phone_number;
        }
        
        if ($request->has('facebook_url')) {
            $headerSettings->facebook_url = $request->facebook_url;
        }
        
        if ($request->has('instagram_url')) {
            $headerSettings->instagram_url = $request->instagram_url;
        }
        
        if ($request->has('youtube_url')) {
            $headerSettings->youtube_url = $request->youtube_url;
        }
        
        $headerSettings->save();

        return redirect()->route('admin.menu-settings')
            ->with('success', 'Header settings updated successfully!');
    }

    // Separate method for updating menu items
    public function updateMenus(Request $request)
    {
        $validated = $request->validate([
            'menus' => 'required|array',
            'menus.*.id' => 'required|exists:menu_settings,id',
            'menus.*.menu_label' => 'required|string|max:100',
            'menus.*.route_name' => 'nullable|string|max:100',
            'menus.*.url' => 'nullable|string|max:255',
            'menus.*.order' => 'required|integer',
            'menus.*.is_active' => 'boolean',
            'menus.*.category' => 'nullable|string|max:100'
        ]);

        // Update menu items
        foreach ($validated['menus'] as $menuData) {
            $menu = MenuSetting::find($menuData['id']);
            $menu->update([
                'menu_label' => $menuData['menu_label'],
                'route_name' => $menuData['route_name'] ?? null,
                'url' => $menuData['url'] ?? null,
                'order' => $menuData['order'],
                'is_active' => $menuData['is_active'] ?? true,
                'category' => $menuData['category'] ?? null
            ]);
        }

        return redirect()->route('admin.menu-settings')
            ->with('success', 'Menu items updated successfully!');
    }

    public function reset()
    {
        $this->seedDefaultMenus();
        
        return redirect()->route('admin.menu-settings')
            ->with('success', 'Menu settings reset to default!');
    }

    private function seedDefaultMenus()
    {
        // Clear existing
        MenuSetting::truncate();
        
        // Default menus
        $defaultMenus = [
            // Main menus
            ['menu_key' => 'home', 'menu_label' => 'HOME', 'menu_type' => 'main', 'order' => 1, 'route_name' => 'home.frontend', 'is_active' => true],
            ['menu_key' => 'about_us', 'menu_label' => 'ABOUT US', 'menu_type' => 'main', 'order' => 2, 'route_name' => 'aboutus.frontend', 'is_active' => true],
            ['menu_key' => 'courses', 'menu_label' => 'COURSES', 'menu_type' => 'main', 'order' => 3, 'url' => '/courses', 'is_active' => true],
            ['menu_key' => 'membership', 'menu_label' => 'MEMBERSHIP', 'menu_type' => 'main', 'order' => 4, 'route_name' => 'membership.frontend', 'is_active' => true],
            
            // Dropdown parents
            ['menu_key' => 'facilities', 'menu_label' => 'FACILITIES', 'menu_type' => 'dropdown_parent', 'order' => 5, 'is_active' => true],
            ['menu_key' => 'tournaments_events', 'menu_label' => 'TOURNAMENTS & EVENTS', 'menu_type' => 'dropdown_parent', 'order' => 6, 'is_active' => true],
            ['menu_key' => 'rates', 'menu_label' => 'RATES', 'menu_type' => 'dropdown_parent', 'order' => 7, 'is_active' => true],
            ['menu_key' => 'contact_us', 'menu_label' => 'CONTACT US', 'menu_type' => 'dropdown_parent', 'order' => 8, 'is_active' => true],
            
            // Facilities children with categories
            ['menu_key' => 'clubhouse', 'menu_label' => 'GOLF CLUB HOUSE', 'menu_type' => 'dropdown_child', 'parent_key' => 'facilities', 'category' => 'CLUB FACILITIES', 'order' => 1, 'route_name' => 'clubhouse.frontend', 'is_active' => true],
            ['menu_key' => 'drivingrange', 'menu_label' => 'DRIVING RANGE', 'menu_type' => 'dropdown_child', 'parent_key' => 'facilities', 'category' => 'CLUB FACILITIES', 'order' => 2, 'route_name' => 'drivingrange.frontend', 'is_active' => true],
            ['menu_key' => 'proshop', 'menu_label' => 'PROSHOP', 'menu_type' => 'dropdown_child', 'parent_key' => 'facilities', 'category' => 'CLUB FACILITIES', 'order' => 3, 'route_name' => 'proshop.frontend', 'is_active' => true],
            ['menu_key' => 'locker', 'menu_label' => "MEN'S AND LADIES LOCKER ROOMS", 'menu_type' => 'dropdown_child', 'parent_key' => 'facilities', 'category' => 'CLUB FACILITIES', 'order' => 4, 'route_name' => 'locker.frontend', 'is_active' => true],
            ['menu_key' => 'lobby', 'menu_label' => 'LOBBY', 'menu_type' => 'dropdown_child', 'parent_key' => 'facilities', 'category' => 'CLUB FACILITIES', 'order' => 5, 'route_name' => 'lobby.frontend', 'is_active' => true],
            ['menu_key' => 'veranda', 'menu_label' => 'VERANDA', 'menu_type' => 'dropdown_child', 'parent_key' => 'facilities', 'category' => 'CLUB FACILITIES', 'order' => 6, 'route_name' => 'veranda.frontend', 'is_active' => true],
            ['menu_key' => 'grill', 'menu_label' => 'GRILLROOM', 'menu_type' => 'dropdown_child', 'parent_key' => 'facilities', 'category' => 'RESTAURANT', 'order' => 7, 'route_name' => 'grill.frontend', 'is_active' => true],
            ['menu_key' => 'teehouse', 'menu_label' => 'TEEHOUSE & TEEPAVILION', 'menu_type' => 'dropdown_child', 'parent_key' => 'facilities', 'category' => 'RESTAURANT', 'order' => 8, 'route_name' => 'teehouse.frontend', 'is_active' => true],
            
            // Tournaments & Events children
            ['menu_key' => 'upcoming_events', 'menu_label' => 'UPCOMING EVENTS', 'menu_type' => 'dropdown_child', 'parent_key' => 'tournaments_events', 'category' => null, 'order' => 1, 'route_name' => 'client.tournaments', 'is_active' => true],
            ['menu_key' => 'course_schedule', 'menu_label' => 'COURSE SCHEDULE', 'menu_type' => 'dropdown_child', 'parent_key' => 'tournaments_events', 'category' => null, 'order' => 2, 'url' => '/coursesched', 'is_active' => true],
            ['menu_key' => 'tournament_gallery', 'menu_label' => 'TOURNAMENT GALLERY', 'menu_type' => 'dropdown_child', 'parent_key' => 'tournaments_events', 'category' => null, 'order' => 3, 'url' => '/tournament_gallery', 'is_active' => true],
            ['menu_key' => 'hole_in_one', 'menu_label' => 'HOLE-IN-ONE', 'menu_type' => 'dropdown_child', 'parent_key' => 'tournaments_events', 'category' => null, 'order' => 4, 'url' => '/hole-in-one', 'is_active' => true],
            
            // Rates children
            ['menu_key' => 'golf_rates', 'menu_label' => 'GOLF RATES', 'menu_type' => 'dropdown_child', 'parent_key' => 'rates', 'category' => null, 'order' => 1, 'route_name' => 'rates2.frontend', 'is_active' => true],
            ['menu_key' => 'tournament_rates', 'menu_label' => 'TOURNAMENT RATES', 'menu_type' => 'dropdown_child', 'parent_key' => 'rates', 'category' => null, 'order' => 2, 'route_name' => 'tournament.rates.frontend', 'is_active' => true],
            
            // Contact Us children
            ['menu_key' => 'contact_details', 'menu_label' => 'CONTACT DETAILS', 'menu_type' => 'dropdown_child', 'parent_key' => 'contact_us', 'category' => null, 'order' => 1, 'route_name' => 'contact.frontend', 'is_active' => true],
            ['menu_key' => 'careers', 'menu_label' => 'CAREERS', 'menu_type' => 'dropdown_child', 'parent_key' => 'contact_us', 'category' => null, 'order' => 2, 'route_name' => 'careers.frontend', 'is_active' => true],
        ];
        
        foreach ($defaultMenus as $menu) {
            MenuSetting::create($menu);
        }
        
        // Create header settings record
        MenuSetting::getHeaderSettings();
    }
}