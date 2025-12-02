<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gpeaks', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title1')->nullable();
            $table->decimal('total1', 10, 2)->nullable();
            $table->text('body1')->nullable();
            $table->text('price1')->nullable();
            $table->string('sched1')->nullable();

            $table->string('title2')->nullable();
            $table->string('paragraph2')->nullable();
            $table->decimal('total2', 10, 2)->nullable();
            $table->text('body2')->nullable();
            $table->text('price2')->nullable();
            $table->string('sched2')->nullable();

            $table->string('title3')->nullable();
            $table->string('paragraph3')->nullable();
            $table->text('body3')->nullable();
            $table->text('price3')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gpeaks');
    }
};
