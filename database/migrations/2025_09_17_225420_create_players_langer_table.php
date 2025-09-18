<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('players_langer', function (Blueprint $table) {
    $table->id();
    $table->string('first_name');
    $table->string('last_name');
    $table->integer('hole_number');
    $table->date('date');
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('players_langer');
    }
};
