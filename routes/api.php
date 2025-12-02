<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RoleAPIController;
use App\Http\Controllers\API\TaskAPIController;
use App\Http\Controllers\API\TaskStatusAPIController;
use App\Http\Controllers\API\TaskStatusHistoryAPIController;
use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\API\UserRolePermissionAPIController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/hash', function () {
    $salt = "";
    return hash("sha512", $salt);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('tasks', TaskAPIController::class);

});
