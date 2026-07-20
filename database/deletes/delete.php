<?php

use Illuminate\Support\Facades\DB;

DB::statement("DELETE FROM photos");

echo "Tabela photos została całkowicie wyczyszczona!\n";