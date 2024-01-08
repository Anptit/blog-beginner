<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::name('post.')->group(function() {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::post('/', [PostController::class, 'create'])->name('create');

    
    Route::get('/edit/{post}', [PostController::class, 'editView'])->name('edit_view');
    Route::post('/edit/{post}', [PostController::class, 'edit'])->name('edit');
});
