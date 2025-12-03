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
        Schema::create('teehouse_contents', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();

            // JSON arrays of stored file paths (public disk)
            $table->json('lf9_images')->nullable();
            $table->json('hwl_images')->nullable();
            $table->json('cf9_images')->nullable();
            $table->json('hwc_images')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teehouse_contents');
    }
};
