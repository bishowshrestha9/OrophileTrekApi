<?php

use App\Http\Controllers\api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleCheck;
use App\Http\Controllers\api\TrekController;
use App\Http\Controllers\api\BlogsController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');



Route::apiResource('treks', TrekController::class);

Route::prefix('blogs')->middleware(['auth:sanctum', 'role'])->group(function () {
    Route::post('/', [BlogsController::class, 'store']);
    Route::post('/{id}', [BlogsController::class, 'update']); // Use POST for file uploads
    Route::delete('/{id}', [BlogsController::class, 'destroy']);
    Route::get('/total', [BlogsController::class, 'getTotalBlogs']);
});

Route::group(['prefix' => 'blogs'], function () {
    Route::get('/{id}', [BlogsController::class, 'show']);
    Route::get('/', [BlogsController::class, 'index']);
});



