<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('course_schedules_contents', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();

            // Langer
            $table->string('langer_status');   // Open / Close / Tournament / Others
            $table->string('langer_other')->nullable(); // Text if status = Others

            // Couples
            $table->string('couples_status');  // Open / Close / Tournament / Others
            $table->string('couples_other')->nullable(); // Text if status = Others

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_schedules_contents');
    }
};
