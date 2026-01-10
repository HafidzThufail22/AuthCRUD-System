<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KotaController;
use App\Http\Controllers\Api\PropinsiController;

// 1. Route Public (Bisa diakses tanpa token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// 2. Route Protected (Harus pakai Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('kota', KotaController::class);
    Route::get('/propinsi', [PropinsiController::class, 'index']);
});
