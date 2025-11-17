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
        Schema::table('hole_in_one_contents', function (Blueprint $table) {
            $table->string('type', 20)->after('id'); // 'couples' or 'langer'
        });
    }

    public function down(): void
    {
        Schema::table('hole_in_one_contents', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
