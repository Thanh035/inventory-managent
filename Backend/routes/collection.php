<?php

use App\Http\Controllers\CollectionController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/admin/collections')->group(function () {
    Route::get('/', [CollectionController::class, 'index']); // Lấy tất cả collections
    Route::get('{id}', [CollectionController::class, 'show']); // Lấy collection theo ID
    Route::post('/', [CollectionController::class, 'store']); // Tạo mới collection
    Route::put('{id}', [CollectionController::class, 'update']); // Cập nhật collection
    Route::delete('{id}', [CollectionController::class, 'destroy']); // Xóa collection
});
