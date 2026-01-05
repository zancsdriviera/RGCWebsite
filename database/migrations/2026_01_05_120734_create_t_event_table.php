<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('event_date');
            $table->string('main_image')->nullable();
            $table->string('secondary_image')->nullable();
            $table->text('subtitles_texts')->nullable();
            $table->text('paragraph')->nullable();
            $table->string('file1')->nullable();
            $table->string('file2')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_events');
    }
};
