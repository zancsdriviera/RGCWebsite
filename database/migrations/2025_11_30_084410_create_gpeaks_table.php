<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gpeaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gsection_id')->constrained('gsections')->onDelete('cascade');
            $table->enum('type', ['title', 'golf_rate']);
            $table->integer('sort_order')->default(0);

            // Title type fields
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            // Golf Rate type fields
            $table->string('gr_title')->nullable();
            $table->text('gr_title_description')->nullable();
            $table->decimal('gr_total', 10, 2)->nullable();
            $table->text('gr_content')->nullable();
            $table->text('gr_content_price')->nullable();
            $table->string('gr_schedule')->nullable();
            $table->text('gr_description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gpeaks');
    }
};