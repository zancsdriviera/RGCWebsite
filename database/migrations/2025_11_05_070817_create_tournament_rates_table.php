<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tournament_rates', function (Blueprint $table) {
            $table->id();
            $table->string('season')->index(); // 'peak' or 'non-peak' (or 'Peak Season' etc.)
            $table->text('green_fee')->nullable();        // multi-line (store many lines)
            $table->decimal('scoring_fee', 10, 2)->nullable();
            $table->decimal('caddie_fee', 10, 2)->nullable();
            $table->decimal('golf_cart_fee', 10, 2)->nullable();
            $table->decimal('hole_in_one_fund', 10, 2)->nullable();
            $table->decimal('sports_dev_fund', 10, 2)->nullable();
            $table->decimal('environmental_fund', 10, 2)->nullable();
            $table->text('food_beverage')->nullable();    // can be NULL
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournament_rates');
    }
};

