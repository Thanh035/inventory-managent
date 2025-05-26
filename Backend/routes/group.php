<?php


use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/admin/settings/group_permissions')->group(function () {
    Route::get('/', [GroupController::class, 'index']);
    Route::post('/', [GroupController::class, 'store']);
    Route::get('{id}', [GroupController::class, 'show']);
    Route::put('{id}', [GroupController::class, 'update']);
    Route::delete('{id}', [GroupController::class, 'destroy']);
});
