<?php

namespace Database\Seeders;

use App\Models\MenuSetting;
use Illuminate\Database\Seeder;

class MenuSettingSeeder extends Seeder
{
    public function run(): void
    {
        $controller = new \App\Http\Controllers\MenuSettingController();
        $controller->reset();
    }
}