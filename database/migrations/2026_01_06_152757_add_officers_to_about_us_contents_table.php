<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            // Add JSON column for officers array
            $table->json('officers')->nullable()->after('boards');
            
            // Optional: Add a separate year field for officers if different from board_year
            // $table->string('officers_year')->nullable()->after('officers');
        });
    }

    public function down()
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->dropColumn('officers');
            // $table->dropColumn('officers_year'); // if added
        });
    }
};