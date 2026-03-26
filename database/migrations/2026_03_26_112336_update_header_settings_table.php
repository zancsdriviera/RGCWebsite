<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('header_settings', function (Blueprint $table) {
            // Drop old menu_items column if it exists
            if (Schema::hasColumn('header_settings', 'menu_items')) {
                $table->dropColumn('menu_items');
            }
            
            // Add new structured menu_items column
            $table->json('menu_items')->nullable()->after('youtube_url');
        });
    }

    public function down(): void
    {
        Schema::table('header_settings', function (Blueprint $table) {
            $table->dropColumn('menu_items');
            $table->json('menu_items')->nullable();
        });
    }
};