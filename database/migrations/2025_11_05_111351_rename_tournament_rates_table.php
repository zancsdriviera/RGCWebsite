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
        Schema::rename('tournament_rates', 'tournament_rates_contents');
    }

    public function down()
    {
        Schema::rename('tournament_rates_contents', 'tournament_rates');
    }
};
