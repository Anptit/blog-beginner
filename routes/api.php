<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('auth')->group(function() {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'create']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password/{user}', [AuthController::class, 'resetPassword']);
});

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [UserController::class, 'index']);
});

Route::prefix('post')->middleware(['auth:sanctum', 'throttle:post'])->group(function() {
    Route::get('/', [PostController::class, 'index']);
    Route::get('{post}', [PostController::class, 'show'])->withTrashed();
    Route::post('/', [PostController::class, 'create']);
    Route::put('edit/{post}', [PostController::class, 'edit'])->withTrashed();
    Route::delete('{post}', [PostController::class, 'destroy']);
});

