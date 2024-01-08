<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return redirect()->route('auth.login');
});

Route::prefix('auth')->name('auth.')->group(function() {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login_handle');

    Route::get('register', [AuthController::class, 'createView'])->name('register');
    Route::post('register', [AuthController::class, 'create'])->name('register_handle');

    Route::get('forgot-password', [AuthController::class, 'forgotPasswordView'])->name('forgot_password');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot_password_handle');

    Route::get('reset-password/{user}', [AuthController::class, 'resetPasswordView'])->name('reset_password');
    Route::post('reset-password/{user}', [AuthController::class, 'resetPassword'])->name('reset_password_handle');

    Route::post('logout', [UserController::class, 'logout'])->name('logout');
});
