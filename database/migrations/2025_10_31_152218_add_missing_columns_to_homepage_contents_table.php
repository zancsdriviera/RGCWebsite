<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('homepage_contents', function (Blueprint $table) {
        $table->text('carousel1Caption')->nullable();
        $table->text('carousel2Caption')->nullable();
        $table->text('carousel3Caption')->nullable();
        $table->text('carousel4Caption')->nullable();
        $table->text('carousel5Caption')->nullable();
    });
}

public function down()
{
    Schema::table('homepage_contents', function (Blueprint $table) {
        $table->dropColumn([
            'carousel1Caption', 'carousel2Caption', 'carousel3Caption',
            'carousel4Caption', 'carousel5Caption'
        ]);
    });
}
};
