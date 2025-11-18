<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('definitive_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->unique();
            $table->string('file_path'); // storage path
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('definitive_contents');
    }
};
