<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_us_contents', function (Blueprint $table) {
            $table->id();

            // Mission & Vision
            $table->string('mission_title')->nullable();
            $table->text('mission_text')->nullable();
            $table->string('mission_image')->nullable();

            $table->string('vision_title')->nullable();
            $table->text('vision_text')->nullable();
            $table->string('vision_image')->nullable();

            // Board of Directors JSON (name, position, image)
            $table->json('boards')->nullable();
            $table->string('board_year')->nullable();

            // Bottom facilities
            $table->string('facilities_caption')->nullable();
            $table->json('facilities_bullets')->nullable();
            $table->string('facilities_image')->nullable();

            // Values / Core Principles JSON (title, description, icon)
            $table->json('values')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us_contents');
    }
};
