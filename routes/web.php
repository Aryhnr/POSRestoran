<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriMenuController;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::get('/dashboard', function() { return view('pages.dashboard'); });
Route::get('/pesanan', function() { return view('pages.pesanan'); });
Route::get('/menu-makanan', function() { return view('pages.menu-makanan'); });
Route::get('/laporan', function() { return view('pages.laporan'); });
// halaman utama menu + kategori
Route::get('/menu-makanan', [KategoriMenuController::class, 'index'])
    ->name('pages.menu-makanan');

// tambah kategori
Route::post('/menu-makanan/kategori/store', [KategoriMenuController::class, 'store'])
    ->name('menu-makanan.kategori.store');

// update kategori
Route::put('/menu-makanan/kategori/{id}', [KategoriMenuController::class, 'update'])
    ->name('menu-makanan.kategori.update');


// hapus kategori
Route::delete('/menu-makanan/kategori/delete/{id}', [KategoriMenuController::class, 'destroy'])
    ->name('menu-makanan.kategori.delete');


