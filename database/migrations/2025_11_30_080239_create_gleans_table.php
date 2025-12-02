<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gleans', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // first, second, third

            // First content fields
            $table->string('title1')->nullable();
            $table->integer('total1')->nullable();
            $table->text('body1')->nullable();
            $table->text('price1')->nullable();
            $table->string('sched1')->nullable();

            // Second content fields
            $table->string('title2')->nullable();
            $table->text('paragraph2')->nullable();
            $table->integer('total2')->nullable();
            $table->text('body2')->nullable();
            $table->text('price2')->nullable();
            $table->string('sched2')->nullable();

            // Third content fields
            $table->string('title3')->nullable();
            $table->text('paragraph3')->nullable();
            $table->text('body3')->nullable();
            $table->text('price3')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gleans');
    }
};
