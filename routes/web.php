<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/gallery', 'pages.gallery')->name('gallery');
Route::view('/articles', 'pages.articles')->name('articles');
Route::view('/gallery2', 'pages.gallery2')->name('gallery2');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/recruitment', 'pages.recruitment')->name('recruitment');
use Illuminate\Support\Facades\DB;

Route::get('/artykuly/{slug}', function ($slug) {
    // 1. Pobieramy artykuł z bazy danych po jego 'slug'
    $article = DB::table('articles')->where('slug', $slug)->firstOrFail();
    // (Jeśli nie używasz modeli, a surowego Query Buildera, użyj poniższego):
    // $article = DB::table('articles')->where('slug', $slug)->firstOrFail();

    // 2. Przekazujemy pobrany artykuł do widoku
    return view('pages.article-single', [
        'article' => $article
    ]);
})->name('articles.show');