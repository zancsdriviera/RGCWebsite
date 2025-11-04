<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('careers_contents', function (Blueprint $table) {
            // Drop old columns if they exist
            $table->dropColumn(['position', 'qualifications_left', 'qualifications_right', 'email']);

            // Add new column for image
            $table->string('career_image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('careers_contents', function (Blueprint $table) {
            $table->string('position')->nullable();
            $table->text('qualifications_left')->nullable();
            $table->text('qualifications_right')->nullable();
            $table->string('email')->nullable();
            $table->dropColumn('career_image');
        });
    }
};
