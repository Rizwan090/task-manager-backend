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



Route::post('signin', [AuthenticationController::class, 'signIn']);
Route::post("register", [AuthenticationController::class, "signUp"]);



Route::get("permissions", [PermissionController::class, "getPermissions"]);
Route::prefix("permission/")->group(function () {
    Route::post("create", [PermissionController::class, "store"]);
    Route::get("{id}", [PermissionController::class, "getById"]);
    Route::delete("{id}", [PermissionController::class, "destroy"]);
    Route::patch("{id}", [PermissionController::class, "update"]);
});

//    Roles Api
Route::get("roles", [RoleController::class, "getRoles"]);
Route::prefix("role/")->group(function () {
    Route::post("create", [RoleController::class, "store"]);
    Route::get("{id}", [RoleController::class, "getById"]);
    Route::delete("{id}", [RoleController::class, "destroy"]);
    Route::patch("{id}", [RoleController::class, "update"]);
    Route::patch("assign-permission/{uuid}", [RoleController::class, "assignPermission"]);
});
