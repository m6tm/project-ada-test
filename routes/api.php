<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function() {
    Route::post('create-post', [PostController::class, 'create']);
    Route::post('create-video', [VideoController::class, 'create']);
    Route::get('posts/{currentPage?}/{postPerPage?}', [PostController::class, 'posts'])->whereNumber('currentPage')->whereNumber('postPerPage');
    Route::post('videos/{currentPage?}/{videoPerPage?}', [VideoController::class, 'videos'])->whereNumber('currentPage')->whereNumber('videoPerPage');
    Route::post('toggle-like', [LikeController::class, 'toggle_likes']);
});

Route::post('', function() {
    return response()->json([
        'code' => 200
    ]);
});

