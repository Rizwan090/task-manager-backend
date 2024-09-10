<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\ProjectController;
use Modules\Core\Http\Controllers\PermissionController;
use Modules\Core\Http\Controllers\RoleController;
use Modules\Admin\Http\Controllers\UserController;
use Modules\User\Http\Controllers\TaskController;

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

    //    Taks route

    Route::get('projects/{projectId}/tasks', [TaskController::class, 'getAll']);
    Route::post('projects/tasks', [TaskController::class, 'store']);
    Route::get('tasks/{id}', [TaskController::class, 'getById']);
    Route::patch('tasks/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
    Route::post('tasks/{taskId}/assign/{userId}', [TaskController::class, 'assignUserToTask']);

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



});


