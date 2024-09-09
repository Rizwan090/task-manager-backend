<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\ProjectController;
use Modules\Core\Http\Controllers\PermissionController;
use Modules\Core\Http\Controllers\RoleController;
use Modules\Admin\Http\Controllers\UserController;

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

Route::middleware(['auth:sanctum', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('users', [UserController::class, 'getAll']);
    Route::post('create', [UserController::class, 'store']);
    Route::patch('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);


    Route::prefix('projects')->group(function () {
        Route::get('v1/projects', [ProjectController::class, 'getAll']);
        Route::post('v1/project', [ProjectController::class, 'store']);
        Route::get('v1/projects/{id}', [ProjectController::class, 'getById']);
        Route::patch('v1/project/{id}', [ProjectController::class, 'update']);
        Route::delete('v1/project/{id}', [ProjectController::class, 'destroy']);
        Route::post('{projectId}/assign-users', [ProjectController::class, 'assignUsers']);
    });




});

Route::get("permissions", [PermissionController::class, "getPermissions"]);
Route::prefix("permission/")->group(function () {
    Route::post("create", [PermissionController::class, "store"]);
    Route::get("{id}", [PermissionController::class, "getById"]);
    Route::delete("{id}", [PermissionController::class, "destroy"]);
    Route::patch("{id}", [PermissionController::class, "update"]);
});

// Roles Api
Route::get("roles", [RoleController::class, "getRoles"]);
Route::prefix("role/")->group(function () {
    Route::post("create", [RoleController::class, "store"]);
    Route::get("{id}", [RoleController::class, "getById"]);
    Route::delete("{id}", [RoleController::class, "destroy"]);
    Route::patch("{id}", [RoleController::class, "update"]);
    Route::patch("assign-permission/{uuid}", [RoleController::class, "assignPermission"]);
});
