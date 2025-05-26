<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

# All Authentication Routes
Route::prefix('api/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'storeUser']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
});



