<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MenuSetting extends Model
{
    use HasFactory;

    protected $fillable = [
    'menu_key',
    'menu_label',
    'menu_type',
    'parent_key',
    'category',
    'order',
    'route_name',
    'url',
    'is_active',
    'header_logo_path',
    'brand_text',
    'phone_number',    
    'facebook_url',    
    'instagram_url',  
    'youtube_url'    
];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    // Get all active main menus
    public static function getMainMenus()
    {
        return self::where('menu_type', 'main')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    // Get dropdown parent menus
    public static function getDropdownParents()
    {
        return self::where('menu_type', 'dropdown_parent')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    // Get children for a specific parent, optionally grouped by category
    public static function getChildren($parentKey)
    {
        return self::where('parent_key', $parentKey)
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->groupBy('category');
    }

    // Get complete menu structure
    public static function getMenuStructure()
    {
        $mainMenus = self::getMainMenus();
        $dropdownParents = self::getDropdownParents();
        
        $structure = [];
        
        // Add main menus
        foreach ($mainMenus as $menu) {
            $structure[] = $menu;
        }
        
        // Add dropdown parents with their children
        foreach ($dropdownParents as $parent) {
            $parent->children = self::getChildren($parent->menu_key);
            $structure[] = $parent;
        }
        
        return collect($structure);
    }
    // Get header settings (logo and brand text)
        public static function getHeaderSettings()
    {
        // Try to find existing header settings record
        $headerSettings = self::where('menu_key', 'header_settings')->first();
        
        if (!$headerSettings) {
            // Create default header settings record with menu_type = 'config' to exclude from menus
            $headerSettings = self::create([
                'menu_key' => 'header_settings',
                'menu_label' => 'Header Settings',
                'menu_type' => 'config',
                'order' => 0,
                'header_logo_path' => null,
                'brand_text' => 'RIVIERA GOLF CLUB',
                'phone_number' => '(046) 409-1077',
                'facebook_url' => 'https://www.facebook.com/RivieraGolfPH',
                'instagram_url' => 'https://www.instagram.com/rivieragolfph/',
                'youtube_url' => 'https://www.youtube.com/@RivieraGolfClubInc.',
                'is_active' => true
            ]);
        }
        
        return $headerSettings;
    }
}