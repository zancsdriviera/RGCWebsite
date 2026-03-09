<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('live_score_headers', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->boolean('status')->default(0); // 0 = disabled, 1 = enabled
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('live_score_headers');
    }
};