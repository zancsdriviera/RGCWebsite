<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('hole_in_one', 'hole_in_one_contents'); // ← rename here
    }

    public function down()
    {
        Schema::rename('hole_in_one', 'hole_in_one_contents'); // ← rollback
    }
};

