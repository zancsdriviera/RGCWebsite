<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('asm_minutes_contents', function (Blueprint $table) {
            // First remove the unique constraint from year
            $table->dropUnique(['year']);
            
            // Add new meeting_date column
            $table->date('meeting_date')->nullable()->after('id');
            
            // If you have existing data, convert year to meeting_date
            // This will be handled in a separate step or via DB::statement
        });
        
        // Convert existing year data to meeting_date (set to Jan 1 of that year)
        \DB::statement("UPDATE asm_minutes_contents SET meeting_date = CONCAT(year, '-01-01')");
        
        // Now make meeting_date required and unique, and drop year column
        Schema::table('asm_minutes_contents', function (Blueprint $table) {
            $table->date('meeting_date')->nullable(false)->unique()->change();
            $table->dropColumn('year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asm_minutes_contents', function (Blueprint $table) {
            // Add year column back
            $table->integer('year')->nullable()->after('id');
        });
        
        // Convert meeting_date back to year
        \DB::statement("UPDATE asm_minutes_contents SET year = YEAR(meeting_date)");
        
        Schema::table('asm_minutes_contents', function (Blueprint $table) {
            $table->integer('year')->nullable(false)->unique()->change();
            $table->dropColumn('meeting_date');
        });
    }
};