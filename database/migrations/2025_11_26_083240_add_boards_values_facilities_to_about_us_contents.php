<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            // If your MySQL supports JSON, you can use json(); otherwise use longText()
            $table->json('boards')->nullable()->after('vision_image');
            $table->json('values')->nullable()->after('boards');
            $table->json('facilities_bullets')->nullable()->after('values');
        });
    }

    public function down()
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->dropColumn(['boards','values','facilities_bullets']);
        });
    }
};
