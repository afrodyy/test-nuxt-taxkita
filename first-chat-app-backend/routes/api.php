<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('jwt.auth')->get('user', function (Request $request) {
    return auth()->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('get-user-data', [AuthController::class, 'getUserData']);
Route::post('get-user-data-by-id', [AuthController::class, 'getUserDataById']);
// Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('logout', [AuthController::class, 'logout']);

Route::get('user', [UserController::class, 'index']);

Route::post('send-message', [MessageController::class, 'sendMessage']);
Route::get('get-message/{sender}/{recipient}', [MessageController::class, 'getMessage']);
