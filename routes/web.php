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
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\Auth\VendorController;
use App\Http\Controllers\Auth\MenuController;
use App\Http\Controllers\Auth\CustomerController;
use App\Http\Controllers\Auth\PesananController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerCameraController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\ScannerVendorController;

/*
|--------------------------------------------------------------------------
| Redirect Root / Public Customer Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', [CustomerController::class, 'index'])->name('landing');

/*
|--------------------------------------------------------------------------
| Public Customer Routes
|--------------------------------------------------------------------------
*/
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::post('/checkout', [PesananController::class, 'checkout'])->name('customer.checkout');

/*
|--------------------------------------------------------------------------
| Public Payment
|--------------------------------------------------------------------------
*/
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::get('/bayar', [PaymentController::class, 'bayar'])->name('payment.bayar');

Route::post('/payment/update-status', [PaymentController::class, 'updateStatus'])
    ->name('payment.updateStatus');

Route::get('/payment/success', [PaymentController::class, 'success'])
    ->name('payment.success');

/*
|--------------------------------------------------------------------------
| Login Pilihan Role
|--------------------------------------------------------------------------
*/
Route::get('/login/admin', function () {
    return redirect('/login?role=admin');
})->name('login.admin');

Route::get('/login/vendor', function () {
    return redirect('/login?role=vendor&type=vendor');
})->name('login.vendor');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Auth::routes();

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/otp-verification', [OtpController::class, 'showOtpForm'])->name('otp.view');
Route::post('/otp-verification', [OtpController::class, 'verifyOtp'])->name('otp.verify');

/*
|--------------------------------------------------------------------------
| Setelah Login
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Redirect Home
    |--------------------------------------------------------------------------
    */
    Route::get('/home', function () {

        if (auth()->user()->role == 'vendor') {
            return redirect('/vendor/dashboard');
        }

        return app(HomeController::class)->index();

    })->name('home');

    /*
    |--------------------------------------------------------------------------
    | Vendor Area
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:vendor'])->group(function () {

        Route::get('/vendor/dashboard', function () {
            $vendor = auth()->user();
            return view('vendor.dashboard', compact('vendor'));
        })->name('vendor.dashboard');

        Route::post('/vendor/logout', function () {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/');
        })->name('vendor.logout');

        /*
        |--------------------------------------------------------------------------
        | Menu Vendor
        |--------------------------------------------------------------------------
        */
        Route::get('/vendor/menu', [MenuController::class, 'index'])->name('vendor.menu.index');
        Route::get('/vendor/menu/create', [MenuController::class, 'create'])->name('vendor.menu.create');
        Route::post('/vendor/menu/store', [MenuController::class, 'store'])->name('vendor.menu.store');
        Route::get('/vendor/menu/edit/{id}', [MenuController::class, 'edit'])->name('vendor.menu.edit');
        Route::post('/vendor/menu/update/{id}', [MenuController::class, 'update'])->name('vendor.menu.update');
        Route::get('/vendor/menu/delete/{id}', [MenuController::class, 'delete'])->name('vendor.menu.delete');

        Route::get('/scanner-barang/search/{kode}', [BarangController::class, 'searchBarcode']);
    });

    Route::delete('/customer-camera/{id}', [CustomerCameraController::class, 'destroy'])
        ->name('customer.destroy');

    Route::get('/scanner-barang', [ScannerController::class, 'index']);
    Route::get('/scanner-barang/search/{kode}', [ScannerController::class, 'search']);
    Route::get('/scanner-vendor', [ScannerVendorController::class, 'index'])->name('scanner.vendor');
    Route::get('/scanner-vendor/search/{kode}', [ScannerVendorController::class, 'search'])->name('scanner.vendor.search');

    /*
    |--------------------------------------------------------------------------
    | Admin Only
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {

        Route::resource('kategori', KategoriController::class);
        Route::resource('buku', BukuController::class);

        Route::post('/barang/cetak', [BarangController::class, 'cetak'])->name('barang.cetak');
        Route::resource('barang', BarangController::class);

        Route::get('/cetak-sertifikat', [PdfController::class, 'generateSertifikat'])->name('sertifikat.cetak');
        Route::get('/cetak-undangan', [PdfController::class, 'generateUndangan'])->name('undangan.cetak');

        Route::get('/customer-camera', [CustomerCameraController::class, 'index'])
            ->name('camera.customer.index');

        Route::get('/customer-camera/create-blob', [CustomerCameraController::class, 'createBlob'])
            ->name('camera.customer.createBlob');

        Route::post('/customer-camera/store-blob', [CustomerCameraController::class, 'storeBlob'])
            ->name('camera.customer.storeBlob');

        Route::get('/customer-camera/create-file', [CustomerCameraController::class, 'createFile'])
            ->name('camera.customer.createFile');

        Route::post('/customer-camera/store-file', [CustomerCameraController::class, 'storeFile'])
            ->name('camera.customer.storeFile');

        /*
        |--------------------------------------------------------------------------
        | MODUL 4
        |--------------------------------------------------------------------------
        */
        Route::prefix('modul4')->group(function () {

            Route::get('/table-html', function () {
                return view('modul4.table-html');
            })->name('modul4.html');

            Route::get('/table-datatable', function () {
                return view('modul4.table-datatable');
            })->name('modul4.datatable');

            Route::get('/select-kota', function () {
                return view('modul4.select-kota');
            })->name('modul4.select');

            Route::get('/wilayah', function () {
                return view('wilayah');
            });

        });

        /*
        |--------------------------------------------------------------------------
        | MODUL 5
        |--------------------------------------------------------------------------
        */
        Route::prefix('modul5')->group(function () {

            Route::get('/wilayah', [WilayahController::class, 'index'])->name('modul5.wilayah');
            Route::get('/pos', [WilayahController::class, 'posIndex'])->name('modul5.pos');

            Route::get('/get-barang/{kode}', [WilayahController::class, 'getBarang']);
            Route::post('/simpan-transaksi', [WilayahController::class, 'simpanTransaksi'])->name('modul5.simpan');

            Route::get('/get-provinsi', [WilayahController::class, 'getProvinsi']);
            Route::get('/get-kota/{id}', [WilayahController::class, 'getKota']);
            Route::get('/get-kecamatan/{id}', [WilayahController::class, 'getKecamatan']);
            Route::get('/get-kelurahan/{id}', [WilayahController::class, 'getKelurahan']);

        });

        /*
        |--------------------------------------------------------------------------
        | MODUL 6
        |--------------------------------------------------------------------------
        */
        Route::prefix('modul6')->group(function () {

            Route::get('/', [CustomerController::class, 'index'])->name('modul6.index');

            Route::get('/dashboard', function () {
                return view('modul6.admin.index');
            })->name('modul6.admin.index');

            /*
            | Vendor
            */
            Route::get('/vendor', [VendorController::class, 'index'])->name('modul6.vendor.index');
            Route::get('/vendor/create', [VendorController::class, 'create'])->name('modul6.vendor.create');
            Route::post('/vendor/store', [VendorController::class, 'store'])->name('modul6.vendor.store');
            Route::get('/vendor/edit/{id}', [VendorController::class, 'edit'])->name('modul6.vendor.edit');
            Route::post('/vendor/update/{id}', [VendorController::class, 'update'])->name('modul6.vendor.update');
            Route::get('/vendor/delete/{id}', [VendorController::class, 'delete'])->name('modul6.vendor.delete');
            Route::get('/vendor/{id}/qr', [VendorController::class, 'qrcode'])->name('modul6.vendor.qr');

            /*
            | Menu
            */
            Route::get('/menu', [MenuController::class, 'index'])->name('modul6.menu.index');
            Route::get('/menu/create', [MenuController::class, 'create'])->name('modul6.menu.create');
            Route::post('/menu/store', [MenuController::class, 'store'])->name('modul6.menu.store');
            Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('modul6.menu.edit');
            Route::post('/menu/update/{id}', [MenuController::class, 'update'])->name('modul6.menu.update');
            Route::get('/menu/delete/{id}', [MenuController::class, 'delete'])->name('modul6.menu.delete');

            /*
            | Customer
            */
            Route::get('/customer', [CustomerController::class, 'index'])->name('modul6.customer.index');
            Route::post('/checkout', [PesananController::class, 'checkout'])->name('modul6.checkout');

            /*
            | Payment
            */
            Route::get('/payment', [PaymentController::class, 'index'])->name('modul6.payment.index');
            Route::get('/bayar', [PaymentController::class, 'bayar'])->name('modul6.payment.bayar');

            /*
            | Pesanan
            */
            Route::get('/pesanan', [PesananController::class, 'index'])
                ->name('modul6.pesanan.index');

            /*
            | Customer Camera
            */
            Route::get('/customer-camera/{id}/edit', [CustomerCameraController::class, 'edit'])
                ->name('customer.edit');

            Route::put('/customer-camera/{id}', [CustomerCameraController::class, 'update'])
                ->name('customer.update');

            Route::delete('/customer-camera/{id}', [CustomerCameraController::class, 'destroy'])
                ->name('customer.destroy');

        });

    });

});