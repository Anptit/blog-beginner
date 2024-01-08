<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->middleware(['auth', 'admin:0'])->group(function () {
    Route::prefix('dashboard')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('home');
    });
});