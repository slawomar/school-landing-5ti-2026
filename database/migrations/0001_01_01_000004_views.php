<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW IF NOT EXISTS newest_photos AS
            SELECT * FROM photos
            ORDER BY updated_at DESC
            LIMIT 5
        ");
        DB::statement("
            CREATE VIEW IF NOT EXISTS newest_labels AS
            SELECT 
                j.value AS label,
                MAX(i.updated_at) AS latest_updated_at,
                i.path AS path
            FROM 
                photos i,
                json_each(i.labels) j
            GROUP BY 
                j.value
            ORDER BY 
                latest_updated_at DESC;
        ");
    }


    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS newest_photos");
        DB::statement("DROP VIEW IF EXISTS newest_labels");
    }
};