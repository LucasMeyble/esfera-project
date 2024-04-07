<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});

Route::resource('/tasks', TasksController::class);
Route::resource('/users', UserController::class);
