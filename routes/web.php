<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\PdfController;

/*
|--------------------------------------------------------------------------
| Redirect Root
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/otp-verification', [OtpController::class, 'showOtpForm'])->name('otp.view');
Route::post('/otp-verification', [OtpController::class, 'verifyOtp'])->name('otp.verify');

/*
|--------------------------------------------------------------------------
| After Login
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /*
    |--------------------------------------------------------------------------
    | Admin Only
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin'])->group(function () {

        // Kategori
        Route::resource('kategori', KategoriController::class);

        // Buku
        Route::resource('buku', BukuController::class);

        // Barang (Modul Tag Harga UMKM)
        Route::resource('barang', BarangController::class);
        Route::get('/barang-cetak', [BarangController::class, 'formCetak'])->name('barang.formCetak');
        Route::post('/barang-cetak', [BarangController::class, 'cetak'])->name('barang.cetak');

        // PDF Sertifikat & Undangan
        Route::get('/cetak-sertifikat', [PdfController::class, 'generateSertifikat'])->name('sertifikat.cetak');
        Route::get('/cetak-undangan', [PdfController::class, 'generateUndangan'])->name('undangan.cetak');
    });
}); 