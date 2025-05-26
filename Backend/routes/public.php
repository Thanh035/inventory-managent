<?php

use App\Http\Controllers\PublicCategoryController;
use App\Http\Controllers\PublicProductController;
use App\Http\Controllers\PublicSupplierController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('/categories', [PublicCategoryController::class, 'index']); // Lấy tất cả products
    Route::get('/suppliers/', [PublicSupplierController::class, 'index']); // Lấy tất cả products
    Route::get('/products/', [PublicProductController::class, 'index']); // Lấy tất cả products
});

