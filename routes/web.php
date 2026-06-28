<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\CustomerController;


// ======================
// LANDING PAGE
// ======================
Route::get('/', function () {
    return view('landing');
});


// ======================
// AUTH
// ======================
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'store']);

Route::post('/logout', [AuthController::class, 'logout']);


// ======================
// CUSTOMER
// ======================
Route::middleware(['auth', 'role:customer'])->group(function () {

    Route::get('/home', [CustomerController::class, 'home']);

    // DETAIL SALON
    Route::get('/salon/{id}', [CustomerController::class, 'detailSalon']);

    // TAMBAH KE KERANJANG
    Route::post('/cart/add/{id}', [CustomerController::class, 'addToCart']);

    // KERANJANG
    Route::get('/cart', [CustomerController::class, 'cart']);

    // CART

    // TAMBAH JUMLAH
    Route::get('/cart/increase/{id}', [CustomerController::class, 'tambahQty']);

    // KURANG JUMLAH
    Route::get('/cart/decrease/{id}', [CustomerController::class, 'kurangQty']);

    // BOOKING
    Route::post('/booking', [CustomerController::class, 'booking']);

    Route::get('/booking/jadwal', [CustomerController::class, 'jadwal']);

    Route::post('/booking/konfirmasi', [CustomerController::class, 'konfirmasi']);
});


// ======================
// MITRA
// ======================
Route::middleware(['auth', 'role:mitra'])->group(function () {

    // ======================
    // DASHBOARD
    // ======================

    Route::get('/mitra/dashboard', [MitraController::class, 'index']);

    Route::get('/mitra/pelanggan', [MitraController::class, 'pelanggan']);

    Route::get('/mitra/riwayat', [MitraController::class, 'riwayat']);

    Route::get('/mitra/profile', [MitraController::class, 'profile']);

    Route::get('/mitra/pelanggan/{id}', [\App\Http\Controllers\MitraController::class,'detailPelanggan']);
    
    #Route::post('/logout', [AuthController::class, 'logout']);

    // SIMPAN DATA SALON
    Route::post('/mitra/salon', [MitraController::class, 'storeSalon']);

    Route::get('/mitra/order', [MitraController::class, 'order']);

    Route::post('/mitra/order/{id}/terima', [MitraController::class, 'terima']);

    Route::post('/mitra/order/{id}/tolak', [MitraController::class, 'tolak']);

    Route::post('/mitra/order/{id}/selesai', [MitraController::class, 'selesai']);





    // ======================
    // LAYANAN
    // ======================

    // HALAMAN LAYANAN
    Route::get('/mitra/layanan', [MitraController::class, 'layanan']);

    // SIMPAN LAYANAN
    Route::post('/mitra/layanan', [MitraController::class, 'storeLayanan']);

    // EDIT LAYANAN
    Route::get('/mitra/layanan/{id}/edit', [MitraController::class, 'editLayanan']);

    // UPDATE LAYANAN
    Route::put('/mitra/layanan/{id}', [MitraController::class, 'updateLayanan']);

    // HAPUS LAYANAN
    Route::delete('/mitra/layanan/{id}', [MitraController::class, 'destroyLayanan']);

});


// ======================
// ADMIN
// ======================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {

        return "Halaman Admin";

    });

});