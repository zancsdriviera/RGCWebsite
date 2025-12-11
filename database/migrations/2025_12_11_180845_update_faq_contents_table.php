<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faq_contents', function (Blueprint $table) {
            // Change category from enum to string
            $table->string('category')->change();
            
            // Remove sort_order column if it exists
            if (Schema::hasColumn('faq_contents', 'sort_order')) {
                $table->dropColumn('sort_order');
            }
        });
    }

    public function down(): void
    {
        Schema::table('faq_contents', function (Blueprint $table) {
            // Revert changes if needed
            $table->enum('category', ['membership', 'tee_times', 'facilities', 'guest_policies'])->change();
            
            // Add back sort_order if needed
            if (!Schema::hasColumn('faq_contents', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('answer');
            }
        });
    }
};