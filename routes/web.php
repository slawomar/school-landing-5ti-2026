<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/gallery', 'pages.gallery')->name('gallery');
Route::view('/gallery2', 'pages.gallery2')->name('gallery2');