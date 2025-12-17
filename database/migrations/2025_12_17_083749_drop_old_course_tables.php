<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop tables if they exist
        if (Schema::hasTable('players_langer')) {
            Schema::dropIfExists('players_langer');
        }
        
        if (Schema::hasTable('players_couples')) {
            Schema::dropIfExists('players_couples');
        }
    }

    public function down()
    {
        // Note: We won't recreate these tables in rollback
        // since they were just for testing
    }
};