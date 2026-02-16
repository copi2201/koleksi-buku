<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Auth;

// 1. Redirect halaman utama ke login
Route::get('/', function () {
    return redirect('/login');
});

// 2. Auth Routes (Login, Register, Logout)
Auth::routes();

// 3. Grup Rute untuk semua user yang sudah login 
Route::middleware(['auth'])->group(function () {

    // Dashboard utama [cite: 41, 47]
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Akses Lihat (Read) untuk semua Role
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

    // 4. Grup Khusus Admin (Hanya Admin yang bisa Tambah, Edit, Hapus)
    Route::middleware(['role:admin'])->group(function () {
        
        // Resource Kategori & Buku kecuali index (karena index sudah di atas)
        Route::resource('kategori', KategoriController::class)->except(['index']);
        Route::resource('buku', BukuController::class)->except(['index']);
        
    });

});