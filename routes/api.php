<?php

use App\Http\Controllers\Api\Task\TaskController;
use App\Http\Controllers\Api\User\Auth\LoginController;
use App\Http\Controllers\Api\User\Auth\RegisterController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
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

Route::post('/login', [LoginController::class, 'loginUser']);
Route::post('/register', [RegisterController::class, 'createUser']);

Route::prefix('/v1/')->middleware('auth:sanctum')->group( function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('tasks', TaskController::class);
});
