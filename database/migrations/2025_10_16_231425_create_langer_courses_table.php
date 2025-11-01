<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('langer_courses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();           // cg-title
            $table->text('description')->nullable();      // cg-desc
            // six image columns
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            $table->string('image6')->nullable();
            $table->timestamps();
        });

        // optionally seed a default row so admin UI always has a record
        DB::table('langer_courses')->insert([
            'title' => 'The Bernhard Langer Course',
            'description' => 'Known For Being One Of The Toughest Courses In The Philippines, This 7,057 Yard Par 71 ...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('langer_courses');
    }
};
