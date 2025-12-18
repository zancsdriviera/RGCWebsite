<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Parent titles & main images
            $table->string('langer_Mtitle');
            $table->string('langer_Mimage')->nullable();
            $table->string('couples_Mtitle');
            $table->string('couples_Mimage')->nullable();

            // Child titles & descriptions
            $table->string('langer_title')->nullable();
            $table->text('langer_description')->nullable();
            $table->string('couples_title')->nullable();
            $table->text('couples_description')->nullable();

            // Gallery images (JSON) with hole numbers
            $table->json('langer_images')->nullable();
            $table->json('couples_images')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
