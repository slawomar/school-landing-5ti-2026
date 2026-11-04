<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;

// --- STRONY PUBLICZNE ---
Route::view('/', 'pages.home')->name('home');
Route::view('/gallery', 'pages.gallery')->name('gallery');
Route::get('/gallery2', [GalleryController::class, 'index'])->name('gallery2');
Route::view('/contact', 'pages.contact')->name('contact');
Route::get('/recruitment', [PageController::class, 'showRecruitment'])->name('pages.recruitment');


// --- ARTYKUŁY (Widok publiczny) ---
Route::view('/articles', 'pages.articles')->name('articles.index'); // Zmieniono z 'articles' na 'articles.index'
Route::get('/articles/{slug}', function ($slug) {
    $article = DB::table('articles')->where('slug', $slug)->firstOrFail();
    return view('pages.article-single', [
        'article' => $article
    ]);
})->name('articles.show');

// --- AUTORYZACJA ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('pages.home');
    })->name('pages.home');
    
    
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// --- ZARZĄDZANIE ARTYKUŁAMI (Edytor / Admin) ---
Route::view('/add-article', 'pages.add-article')->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store'); // Zmieniono z 'articles' na 'articles.store'

Route::middleware('auth')->group(function () {
    Route::get('/articles/{slug}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{slug}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{slug}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

// --- ZARZĄDZANIE GALERIĄ ---
Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
Route::get('/gallery/edit/{slug}', [GalleryController::class, 'edit'])->name('gallery.edit');
Route::put('/gallery/edit/{slug}', [GalleryController::class, 'update'])->name('gallery.update');
Route::delete('/gallery/delete/{slug}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    // Trasy zarządzania użytkownikami
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
});

Route::middleware(['auth'])->group(function () {
    Route::put('/pages/update', [PageController::class, 'updatePage'])->name('pages.update');
    Route::post('/admin/pages/upload-file', [PageController::class, 'uploadFile'])->name('pages.upload_file');
});