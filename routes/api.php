<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UmkmController;
use App\Http\Controllers\api\UlasanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("umkm")->group(function () {
    Route::get('/', [UmkmController::class, 'getAll']);
    Route::get('/{id}', [UmkmController::class, 'getById']);
    Route::post('/registrasi-umkm', [UmkmController::class, 'register']);
    Route::post('/masuk-umkm', [UmkmController::class, 'login']);
    Route::post('/forgot-password', [UmkmController::class, 'forgotPassword']);
    Route::post('/reset-password', [UmkmController::class, 'resetPassword']);
    Route::post('/verifikasi-otp', [UmkmController::class, 'verifikasiOtp']);
    Route::post('/kirim-ulang-otp', [UmkmController::class, 'kirimUlangOtp']);
});

Route::prefix("ulasans")->group(function () {
    Route::get('/', [UlasanController::class, 'getAll']);
    Route::get('/produk/{id}', [UlasanController::class, 'getByIdProduk']);
    Route::get('/umkm/{id}', [UlasanController::class, 'getByIdUmkm']);
    Route::post('/', [UlasanController::class, 'create']);
    Route::put('/{id}', [UlasanController::class, 'update']);
    Route::delete('/{id}', [UlasanController::class, 'destroy']);
});

Route::prefix("auth/register")->group(function () {
    Route::post('/umkm', [AuthController::class, 'registerUmkm']);
    Route::post('/pembeli', [AuthController::class, 'registerPembeli']);
});

Route::prefix("auth/login")->group(function () {
    Route::post('/umkm', [AuthController::class, 'loginUmkm']);
    Route::post('/pembeli', [AuthController::class, 'loginPembeli']);
});
