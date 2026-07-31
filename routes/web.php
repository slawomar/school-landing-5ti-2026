<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/gallery', 'pages.gallery')->name('gallery');
Route::view('/articles', 'pages.articles')->name('articles');
use App\Http\Controllers\GalleryController;

Route::get('/gallery2', [GalleryController::class, 'index'])->name('gallery2');Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/recruitment', 'pages.recruitment')->name('recruitment');
use Illuminate\Support\Facades\DB;

Route::get('/articles/{slug}', function ($slug) {
    $article = DB::table('articles')->where('slug', $slug)->firstOrFail();
    return view('pages.article-single', [
        'article' => $article
    ]);
})->name('articles.show');

Route::view('/login', 'pages.login')->name('login');
use App\Http\Controllers\Auth\LoginController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('pages.home');
    })->name('pages.home');
});

Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
Route::view('/add-article', 'pages.add-article')->name('add-article');
use App\Http\Controllers\ArticleController;

Route::post('/articles', [ArticleController::class, 'store'])->name('articles');

Route::get('/articles/{slug}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::delete('/articles/{slug}', [ArticleController::class, 'destroy'])->name('articles.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/articles/{slug}/edit', [ArticleController::class, 'edit'])->name('articles.edit');

    Route::put('/articles/{slug}', [ArticleController::class, 'update'])->name('articles.update');
});
Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');

Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
Route::get('/gallery/edit/{slug}', [GalleryController::class, 'edit'])->name('gallery.edit');

Route::put('/gallery/edit/{slug}', [GalleryController::class, 'update'])->name('gallery.update');

Route::delete('/gallery/delete/{slug}', [GalleryController::class, 'destroy'])->name('gallery.destroy');