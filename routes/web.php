<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::get('/dashboard', function() { return view('pages.dashboard'); });
Route::get('/pesanan', function() { return view('pages.pesanan'); });
Route::get('/menu-makanan', function() { return view('pages.menu-makanan'); });
Route::get('/laporan', function() { return view('pages.laporan'); });
