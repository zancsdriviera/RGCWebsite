<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('department'); // 'main' or 'department'
            // for main (type = main)
            $table->text('address')->nullable();
            $table->string('main_phone')->nullable();

            // for department rows (type = department)
            $table->string('title')->nullable();    // department name
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Insert a default main row so admin UI has it immediately
        DB::table('contact_us')->insert([
            'type' => 'main',
            'address' => 'RIVIERA GOLF CLUB INC. BY PASS ROAD AGUINALDO HIGHWAY SILANG, CAVITE, PHILIPPINES, 4118',
            'main_phone' => '(046) 409-1077',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
};
