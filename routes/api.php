<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;

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
Route::middleware('auth:sanctum')->group(function () {
    Route::get('users/current-user', [UserController::class, "getCurrentUser"]);

    Route::resource('user/posts', UserPostController::class, ['as' => 'user'])->except(['edit','create']);

//    Route::get('posts', [PostController::class, "index"]);
//    Route::get('posts/{post}', [PostController::class, "show"]);
//    Route::post('posts', [PostController::class, "store"]);
//    Route::put('posts/{post}', [PostController::class, "update"]);
//    Route::delete('posts/{post}', [PostController::class, "destroy"]);
});

Route::post('/tokens/issue', [AuthController::class, "login"])->name('tokens.issue');
