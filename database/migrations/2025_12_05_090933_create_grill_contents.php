<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grill_contents', function (Blueprint $table) {
            $table->id();
            // store arrays as JSON on DB
            $table->json('carousel_images')->nullable();
            $table->json('menu_items')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grill_contents');
    }
};
