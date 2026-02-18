<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teehouse_contents', function (Blueprint $table) {
            $table->json('teepav_images')->nullable()->after('id'); // <-- Add before lf9_images
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teehouse_contents', function (Blueprint $table) {
            $table->dropColumn('teepav_images');
        });
    }
};
