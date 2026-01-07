<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tournament_rates_contents', function (Blueprint $table) {
            $table->string('contact_phone')->nullable()->after('food_beverage');
            $table->string('contact_email')->nullable()->after('contact_phone');
        });
    }

    public function down(): void
    {
        Schema::table('tournament_rates_contents', function (Blueprint $table) {
            $table->dropColumn(['contact_phone', 'contact_email']);
        });
    }
};