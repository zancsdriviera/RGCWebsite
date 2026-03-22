<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gleans', function (Blueprint $table) {
            // Add new column for storing settings value
            $table->string('setting_key')->nullable()->after('type');
            $table->text('setting_value')->nullable()->after('setting_key');
        });
    }

    public function down(): void
    {
        Schema::table('gleans', function (Blueprint $table) {
            $table->dropColumn(['setting_key', 'setting_value']);
        });
    }
};