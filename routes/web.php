<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriMenuController;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::get('/dashboard', function() { return view('pages.dashboard'); });
Route::get('/pesanan', function() { return view('pages.pesanan'); });
Route::get('/menu-makanan', function() { return view('pages.menu-makanan'); });
Route::get('/laporan', function() { return view('pages.laporan'); });

// Kategori
Route::get('/menu-makanan', [KategoriMenuController::class, 'index'])
    ->name('pages.menu-makanan');
Route::post('/menu-makanan/kategori/store', [KategoriMenuController::class, 'store'])
    ->name('menu-makanan.kategori.store');
Route::put('/menu-makanan/kategori/{id}', [KategoriMenuController::class, 'update'])
    ->name('menu-makanan.kategori.update');
Route::delete('/menu-makanan/kategori/delete/{id}', [KategoriMenuController::class, 'destroy'])
    ->name('menu-makanan.kategori.delete');

// Menu
Route::get('/menu-makanan', [MenuController::class, 'index'])
    ->name('pages.menu-makanan');
Route::post('/menu-makanan/store', [MenuController::class, 'store'])
    ->name('menu-makanan.store');
Route::put('/menu-makanan/update/{id}', [MenuController::class, 'update'])
    ->name('menu-makanan.update');
Route::delete('/menu-makanan/delete/{id}', [MenuController::class, 'destroy'])
    ->name('menu-makanan.destroy');



