<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;

Route::apiResource('projects', ProjectController::class);

Route::apiResource('tasks', TaskController::class);

Route::apiResource('tasks.comments', CommentController::class)->shallow();

Route::get('/external/tasks', [
    \App\Http\Controllers\ExternalApiController::class,
    'index'
]);

Route::get('/external/tasks/{id}', [
    \App\Http\Controllers\ExternalApiController::class,
    'show'
]);

Route::post('/external/tasks', [
    \App\Http\Controllers\ExternalApiController::class,
    'store'
]);
