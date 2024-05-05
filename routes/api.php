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
Route::post('/register', [RegisterController::class, 'registerUser']);

Route::prefix('/v1/')->middleware('auth:sanctum')->group( function () {
    Route::get('tasks', [TaskController::class, 'index'])->middleware('check.permission:show_tasks');
    Route::get('tasks/{id}', [TaskController::class, 'show'])->middleware('check.permission:edit_tasks');
    Route::post('tasks', [TaskController::class, 'store'])->middleware('check.permission:add_tasks');
    Route::put('tasks/{id}', [TaskController::class, 'update'])->middleware('check.permission:update_tasks');
    Route::delete('tasks/{id}', [TaskController::class, 'destroy'])->middleware('check.permission:delete_tasks');

    Route::apiResource('users', UserController::class);
});
