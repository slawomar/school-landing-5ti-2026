<?php
use Illuminate\Support\Facades\DB;

// Wykonuje: SELECT * FROM photos
$photos = DB::table('photos')->get();

// Przechodzimy pętlą przez każdy wiersz z bazy danych
foreach ($photos as $photo) {
    // Zakładamy, że tabela ma kolumny 'id', 'title' i 'url'
    echo "ID: {$photo->id} | Tytuł: {$photo->title} | Link: {$photo->url}\n";
}