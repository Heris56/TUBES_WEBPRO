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
});

Route::prefix("ulasans")->group(function () {
    Route::get('/', [UlasanController::class, 'getAll']);
    Route::get('/produk/{id}', [UlasanController::class, 'getByIdProduk']);
    Route::get('/umkm/{id}', [UlasanController::class, 'getByIdUmkm']);
    Route::post('/', [UlasanController::class, 'create']);
    Route::put('/{id}', [UlasanController::class, 'update']);
    Route::delete('/{id}', [UlasanController::class, 'destroy']);
});

Route::prefix('auth')->group(function () {
    // UMKM
    Route::prefix('umkm')->group(function () {
        Route::post('/register', [AuthController::class, 'registerUmkm']);
        Route::post('/login', [AuthController::class, 'loginUmkm']);
        // Route::post('/forgot-password', [AuthController::class, 'forgotPasswordUmkm']);
        // Route::post('/reset-password', [AuthController::class, 'resetPasswordUmkm']);
    });

    // Pembeli
    Route::prefix('pembeli')->group(function () {
        Route::post('/register', [AuthController::class, 'registerPembeli']);
        Route::post('/login', [AuthController::class, 'loginPembeli']);
        // Route::post('/forgot-password', [AuthController::class, 'forgotPasswordPembeli']);
        // Route::post('/reset-password', [AuthController::class, 'resetPasswordPembeli']);
    });
});

Route::post('/login', [AuthController::class, 'login']);
