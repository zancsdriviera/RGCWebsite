<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('live_scores', function (Blueprint $table) {
            $table->id();
            $table->string('team');
            $table->integer('couples_grs')->default(0);
            $table->integer('couples_net')->default(0);
            $table->integer('langer_grs')->default(0);
            $table->integer('langer_net')->default(0);
            $table->integer('total_grs')->default(0);
            $table->integer('total_net')->default(0);
            $table->enum('class', ['A', 'B', 'C', 'LADIES', 'SPECIAL', 'SPONSOR'])->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('live_scores');
    }
};