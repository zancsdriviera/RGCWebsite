<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Use raw SQL to safely check and remove columns
        if (DB::connection()->getDriverName() === 'mysql') {
            $this->removeColumnIfExists('faq_contents', 'icon');
            $this->removeColumnIfExists('faq_contents', 'document_link_text');
            $this->removeColumnIfExists('faq_contents', 'faq_icon_class');
            $this->removeColumnIfExists('faq_contents', 'question');
            $this->removeColumnIfExists('faq_contents', 'answer');
            
            // Also make sure type column is correct enum
            DB::statement("ALTER TABLE faq_contents MODIFY COLUMN type ENUM('doc', 'qr') DEFAULT 'doc'");
            
            // Update any existing 'qa' to 'doc'
            DB::table('faq_contents')
                ->where('type', 'qa')
                ->update(['type' => 'doc']);
        }
    }

    public function down()
    {
        if (DB::connection()->getDriverName() === 'mysql') {
            // Restore columns
            if (!Schema::hasColumn('faq_contents', 'icon')) {
                DB::statement("ALTER TABLE faq_contents ADD COLUMN icon VARCHAR(255) NULL AFTER category");
            }
            
            if (!Schema::hasColumn('faq_contents', 'document_link_text')) {
                DB::statement("ALTER TABLE faq_contents ADD COLUMN document_link_text VARCHAR(255) NULL AFTER document_title");
            }
            
            if (!Schema::hasColumn('faq_contents', 'faq_icon_class')) {
                DB::statement("ALTER TABLE faq_contents ADD COLUMN faq_icon_class VARCHAR(255) NULL AFTER faq_image");
            }
            
            if (!Schema::hasColumn('faq_contents', 'question')) {
                DB::statement("ALTER TABLE faq_contents ADD COLUMN question TEXT NULL");
            }
            
            if (!Schema::hasColumn('faq_contents', 'answer')) {
                DB::statement("ALTER TABLE faq_contents ADD COLUMN answer TEXT NULL");
            }
            
            // Change type back
            DB::statement("ALTER TABLE faq_contents MODIFY COLUMN type ENUM('qa', 'qr') DEFAULT 'qa'");
            
            // Update 'doc' back to 'qa'
            DB::table('faq_contents')
                ->where('type', 'doc')
                ->update(['type' => 'qa']);
        }
    }
    
    private function removeColumnIfExists($table, $column)
    {
        $result = DB::select("SHOW COLUMNS FROM {$table} LIKE '{$column}'");
        if (count($result) > 0) {
            DB::statement("ALTER TABLE {$table} DROP COLUMN {$column}");
        }
    }
};