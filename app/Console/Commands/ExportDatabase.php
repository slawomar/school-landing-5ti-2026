<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ExportDatabase extends Command
{
    protected $signature = 'db:export-sql';
    protected $description = 'Eksportuje dane z bazy do pliku dane.sql';

    public function handle()
    {
        $outputFile = base_path('dane.sql');
        $sql = "SET FOREIGN_KEY_CHECKS=0;\n\n";

        $tables = Schema::getTableListing();

        foreach ($tables as $table) {
            // Pomijamy migracje i widoki
            if (in_array($table, ['migrations', 'sqlite_sequence', 'newest_labels', 'newest_photos'])) {
                continue;
            }

            $rows = DB::table($table)->get();

            foreach ($rows as $row) {
                $array = (array) $row;
                $keys = array_keys($array);
                $values = array_map(function ($value) {
                    if (is_null($value)) return 'NULL';
                    return "'" . addslashes($value) . "'";
                }, array_values($array));

                $sql .= "INSERT INTO `{$table}` (`" . implode('`, `', $keys) . "`) VALUES (" . implode(', ', $values) . ");\n";
            }
        }

        $sql .= "\nSET FOREIGN_KEY_CHECKS=1;\n";

        file_put_contents($outputFile, $sql);

        $this->info("✔ Plik wygenerowany pomyślnie w: {$outputFile}");
    }
}
