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
    Schema::create('homepage_contents', function (Blueprint $table) {
        $table->id();
        $table->string('carousel1')->nullable();
        $table->string('carousel2')->nullable();
        $table->string('carousel3')->nullable();
        $table->string('carousel4')->nullable();
        $table->string('carousel5')->nullable();
        $table->string('headline')->nullable();
        $table->text('subheadline')->nullable();
        $table->string('card1_image')->nullable();
        $table->string('card1_title')->nullable();
        $table->string('card2_image')->nullable();
        $table->string('card2_title')->nullable();
        $table->string('card3_image')->nullable();
        $table->string('card3_title')->nullable();
        $table->text('map_embed')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_contents');
    }
};
