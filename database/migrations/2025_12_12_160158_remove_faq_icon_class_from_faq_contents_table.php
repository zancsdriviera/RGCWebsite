<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('faq_contents', function (Blueprint $table) {
            $table->dropColumn('faq_icon_class');
        });
    }

    public function down()
    {
        Schema::table('faq_contents', function (Blueprint $table) {
            $table->string('faq_icon_class')->nullable()->after('faq_image');
        });
    }
};