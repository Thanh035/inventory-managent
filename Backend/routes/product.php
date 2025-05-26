<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/admin/products')->group(function () {
    Route::get('/', [ProductController::class, 'index']); // Lấy tất cả products
    Route::get('{id}', [ProductController::class, 'show']); // Lấy product theo ID
    Route::post('/', [ProductController::class, 'store']); // Tạo mới product
    Route::put('{id}', [ProductController::class, 'update']); // Cập nhật product
    Route::delete('{id}', [ProductController::class, 'destroy']); // Xóa product

    Route::delete('/', [ProductController::class, 'deleteProducts']);
    Route::get('{id}/product-image', [ProductController::class, 'getImage']);
    Route::post('{id}/product-image', [ProductController::class, 'uploadImage']);
});


