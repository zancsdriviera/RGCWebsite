<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('couples_courses', function (Blueprint $table) {
    $table->id();
    $table->string('title')->nullable();
    $table->text('description')->nullable();
    $table->string('image1')->nullable();
    $table->string('image2')->nullable();
    $table->string('image3')->nullable();
    $table->string('image4')->nullable();
    $table->string('image5')->nullable();
    $table->string('image6')->nullable();
    $table->timestamps();
});

// optionally seed a default row
DB::table('couples_courses')->insert([
    'title' => 'The Fred Couples Course',
    'description' => 'Designed by everybody’s favorite golfer Freddie Couples...',
    'created_at' => now(),
    'updated_at' => now(),
]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couples_courses');
    }
};
