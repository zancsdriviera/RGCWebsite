<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('membership_contents', function (Blueprint $table) {
            $table->id();
            $table->string('type');       // download, applicant, bank
            $table->string('title')->nullable();
            $table->string('file_path')->nullable();
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->integer('age')->nullable();
            $table->string('avatar')->nullable();
            $table->string('top_image')->nullable();
            $table->string('qr_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_contents');
    }
};
