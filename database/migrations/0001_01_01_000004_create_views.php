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
WITH ranked_labels AS (
    SELECT 
        j.value AS label,
        i.updated_at AS latest_updated_at,
        i.path AS path,
        ROW_NUMBER() OVER (PARTITION BY j.value ORDER BY i.updated_at DESC) AS rn
    FROM 
        photos i,
        JSON_TABLE(
            i.labels, 
            '$[*]' COLUMNS (value VARCHAR(255) PATH '$')
        ) AS j
)
SELECT 
    label, 
    latest_updated_at, 
    path
FROM 
    ranked_labels
WHERE 
    rn = 1
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