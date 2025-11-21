<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('icons', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Friendly name like "Facebook"
            $table->string('class'); // CSS class like "bi bi-facebook"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('icons');
    }
};
