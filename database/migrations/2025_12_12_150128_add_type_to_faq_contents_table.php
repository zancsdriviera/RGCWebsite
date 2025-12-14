<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('faq_contents', function (Blueprint $table) {
            $table->enum('type', ['qa', 'qr'])->default('qa')->after('id');
            $table->string('faq_title')->nullable()->after('category'); // For QR items
            $table->string('faq_image')->nullable()->after('faq_title'); // For QR items
            $table->string('faq_icon_class')->nullable()->after('faq_image'); // For QR items
        });
    }

    public function down()
    {
        Schema::table('faq_contents', function (Blueprint $table) {
            $table->dropColumn(['type', 'faq_title', 'faq_image', 'faq_icon_class']);
        });
    }
};