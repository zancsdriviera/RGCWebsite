<?php

namespace Database\Seeders;

use App\Models\MenuSetting;
use Illuminate\Database\Seeder;

class AnnouncementMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Add Announcement as a main menu item
        MenuSetting::create([
            'menu_key' => 'announcement',
            'menu_label' => 'ANNOUNCEMENT',
            'menu_type' => 'main',
            'order' => 9, // Adjust order as needed (after existing menus)
            'route_name' => 'announcement.index',
            'is_active' => true
        ]);
    }
}