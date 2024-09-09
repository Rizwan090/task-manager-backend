<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\PermissionController;
use Modules\Core\Http\Controllers\RoleController;
use Modules\User\Http\Controllers\AuthenticationController;
use Modules\User\Http\Controllers\UserController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/



Route::post('v1/login', [AuthenticationController::class, 'signIn']);
Route::post('v1/register', [AuthenticationController::class, 'signUp']);
Route::post('v1/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {
    Route::get('v1/profile', [UserController::class, 'getAuthUser']);
    Route::patch('v1/profile', [UserController::class, 'updateAuthUser']);
});
