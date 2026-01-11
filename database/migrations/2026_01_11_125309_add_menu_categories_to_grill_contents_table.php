<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('grill_contents', function (Blueprint $table) {
            $table->json('menu_categories')->nullable()->after('menu_items');
        });
    }

    public function down()
    {
        Schema::table('grill_contents', function (Blueprint $table) {
            $table->dropColumn('menu_categories');
        });
    }
};