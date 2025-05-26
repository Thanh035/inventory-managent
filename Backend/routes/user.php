<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->prefix("api/admin/users")
    ->group(function () {
        Route::get('/', 'index');
        Route::get('{id}', 'show');
        Route::post('/', 'store');
        Route::put('{id}', 'update');
//        Route::put('{id}', [CollectionController::class, 'update']);
        Route::delete('{id}', 'destroy');
    });
