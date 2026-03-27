<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_settings', function (Blueprint $table) {
            $table->id();
            $table->string('menu_key')->unique(); // e.g., 'home', 'about_us', etc.
            $table->string('menu_label'); // Display text
            $table->string('menu_type')->default('main'); // 'main', 'dropdown_parent', 'dropdown_child'
            $table->string('parent_key')->nullable(); // For dropdown children, reference parent menu_key
            $table->integer('order')->default(0); // For sorting
            $table->string('route_name')->nullable(); // Route name if applicable
            $table->string('url')->nullable(); // Custom URL if not using route
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_settings');
    }
};