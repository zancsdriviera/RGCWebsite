<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('membership_contents', function (Blueprint $table) {
            if (Schema::hasColumn('membership_contents', 'name')) {
    $table->dropColumn('name');
}
        if (Schema::hasColumn('membership_contents', 'company')) {
            $table->dropColumn('company');
        }
        if (Schema::hasColumn('membership_contents', 'position')) {
            $table->dropColumn('position');
        }
        if (Schema::hasColumn('membership_contents', 'age')) {
            $table->dropColumn('age');
        }
        if (Schema::hasColumn('membership_contents', 'avatar')) {
            $table->dropColumn('avatar');
        }

        });
    }

    public function down()
    {
        Schema::table('membership_contents', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->integer('age')->nullable();
            $table->string('avatar')->nullable();
        });
    }
};
