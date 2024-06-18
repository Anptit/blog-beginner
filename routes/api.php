<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
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
Route::prefix('auth')->middleware('auth:api')->group(function() {
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

Route::prefix('comment')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::get('{comment}', [CommentController::class, 'show'])->withTrashed();
    Route::post('/', [CommentController::class, 'create']);
    Route::put('edit/{comment}', [CommentController::class, 'edit'])->withTrashed();
    Route::delete('{comment}', [CommentController::class, 'destroy']);
});

Route::get('/redirect', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));
 
    $query = http_build_query([
        'client_id' => 3,
        'redirect_uri' => 'http://127.0.0.1:8001/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
        // 'prompt' => '', // "none", "consent", or "login"
    ]);
 
    return redirect('/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $state = $request->session()->pull('state');
 
    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class,
        'Invalid state value.'
    );
 
    $response = Http::asForm()->post('http://127.0.0.1:8000/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => 3,
        'client_secret' => 'vTZYUNrUDkKU5FAkXxwYk9SNC1mWlgIikyNYIN6a',
        'redirect_uri' => 'http://127.0.0.1:8001/callback',
        'code' => $request->code,
    ]);
 
    return $response->json();
});



