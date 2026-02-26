<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('T_Events', function (Blueprint $table) {
            $table->string('winners_image')->nullable()->after('secondary_image');
        });
    }

    public function down()
    {
        Schema::table('T_Events', function (Blueprint $table) {
            $table->dropColumn('winners_image');
        });
    }
};
