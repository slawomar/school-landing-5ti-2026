<?php
use Illuminate\Support\Facades\DB;

// Zmiana z '/najnowsze-zdjecia' na '/' sprawi, że kod zadziała na stronie głównej
Route::get('/p', function () {
    $photos = DB::table('photos')
        ->orderByDesc('updated_at')
        ->limit(6)
        ->get();

    return view('pages.home', [
        'photos' => $photos
    ]);
});