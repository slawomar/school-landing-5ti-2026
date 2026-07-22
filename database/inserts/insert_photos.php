<?php

use Illuminate\Support\Facades\DB;

$now = now()->toDateTimeString();

// DB::statement("
//     INSERT INTO photos (path, description, labels, created_at, updated_at) 
//     VALUES 
//     ('college/assets/img/blog/blog-post-1.webp', 'opis zdjęcia', '[\"do galerii zdjęć\"]', '{$now}', '{$now}'),
//     ('college/assets/img/blog/blog-post-2.webp', 'opis zdjęcia', '[\"do galerii zdjęć\"]', '{$now}', '{$now}'),
//     ('college/assets/img/blog/blog-post-square-1.webp', 'opis zdjęcia', '[\"do galerii zdjęć\"]', '{$now}', '{$now}'),
//     ('college/assets/img/blog/blog-post-square-2.webp', 'opis zdjęcia', '[\"do galerii zdjęć\"]', '{$now}', '{$now}'),
//     ('college/assets/img/blog/blog-post-square-3.webp', 'opis zdjęcia', '[\"do galerii zdjęć\"]', '{$now}', '{$now}'),
//     ('college/assets/img/blog/blog-post-square-4.webp', 'opis zdjęcia', '[\"do galerii zdjęć\"]', '{$now}', '{$now}')
// ");

// DB::statement("
//     INSERT INTO photos (path, description, labels, created_at, updated_at) 
//     VALUES 
//     ('college/assets/img/blog/blog-post-4.webp', 'opis zdjęcia', '[\"xd\"]', '{$now}', '{$now}')
// ");


$folder = storage_path('../public/college/assets/img/dwadziescia_lat');

if (!file_exists($folder) || !is_dir($folder)) {
    echo "BŁĄD: Katalog nie istnieje: {$folder}\n";
    exit;
}$files = array_diff(scandir($folder), ['.', '..']);

foreach ($files as $file) {
        DB::table('photos')->insert([
            'path' => 'college/assets/img/dwadziescia_lat/' . $file,
            'description' => null,
            'labels' => json_encode(['20 lat']),
            'created_at' => '2024-09-11 18:12:10',
            'updated_at' => '2024-09-11 18:12:10',
        ]);
    
}
echo "Zdjęcia zostały pomyślnie dodane za pomocą surowego SQL!\n";
