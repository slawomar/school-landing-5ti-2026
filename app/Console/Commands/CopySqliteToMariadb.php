<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CopySqliteToMariadb extends Command
{
    protected $signature = 'db:copy-sqlite';
    protected $description = 'Kopiuje wszystkie dane z database.sqlite do MariaDB';

    public function handle()
    {
        $this->info('Rozpoczynam kopiowanie danych z SQLite do MariaDB...');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $tables = Schema::connection('sqlite')->getTableListing();

        foreach ($tables as $table) {
            // Oczyszczamy nazwę tabeli z prefiksu 'main.' jeśli SQLite go dodał
            $tableName = str_replace('main.', '', $table);

            // Pomijamy tabele systemowe, migracje oraz widoki
            if (in_array($tableName, ['migrations', 'sqlite_sequence', 'newest_labels'])) {
                continue;
            }

            // Sprawdzamy czy tabela fizycznie istnieje w MariaDB przed próbą czyyszczenia
            if (!Schema::hasTable($tableName)) {
                $this->warn("Tabela [{$tableName}] nie istnieje w MariaDB — pomijam.");
                continue;
            }

            // Czyszczenie tabeli w MariaDB
            DB::table($tableName)->truncate();

            // Pobranie danych z SQLite z czystej nazwy tabeli
            $rows = DB::connection('sqlite')->table($tableName)->get();

            if ($rows->isEmpty()) {
                $this->line("Tabela [{$tableName}] jest pusta — pomijam.");
                continue;
            }

            $data = json_decode(json_encode($rows), true);

            DB::table($tableName)->insert($data);

            $this->info("✔ Skopiowano tabelę [{$tableName}]: " . count($data) . " wierszy.");
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('Gotowe! Wszystkie dane z SQLite są w MariaDB.');
    }
}
