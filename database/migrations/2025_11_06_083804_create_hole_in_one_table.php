<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('hole_in_one_contents', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['couples', 'langer'])->index(); // distinguish origin/type
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->unsignedTinyInteger('hole_number'); // 1..18
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hole_in_one_contents');
    }
};
