<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\ProjectController;
use Modules\User\Http\Controllers\AuthenticationController;
use Modules\User\Http\Controllers\CommentController;
use Modules\User\Http\Controllers\TaskController;
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


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('v1/project', [ProjectController::class, 'getUserProjects']);
    Route::get('v1/project/{id}', [ProjectController::class, 'getById']);


//    Taks route
    Route::get('projects/{projectId}/tasks', [TaskController::class, 'getAll']);
    Route::get('tasks/{id}', [TaskController::class, 'getById']);
    Route::patch('tasks/{id}', [TaskController::class, 'update']);

//    comment rote

    Route::prefix('comments')->group(function () {
        Route::post('v1/comments', [CommentController::class, 'create']);
        Route::get('v1/comments/task/{taskId}', [CommentController::class, 'getAllByTaskId']);
        Route::get('v1/comments/{id}', [CommentController::class, 'findById']);
        Route::patch('v1/comments/{id}', [CommentController::class, 'update']);
        Route::delete('v1/comments/{id}', [CommentController::class, 'delete']);
    });
});

