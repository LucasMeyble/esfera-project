<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return 'User';
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('auth.index');
    Route::post('login', 'authenticate')->name('auth.login');
    Route::get('logout', 'destroy')->name('auth.destroy');
});

Route::resource('/tasks', TasksController::class)->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/tasks/delete/{id}', [TasksController::class, 'destroy'])->name('tasks.delete');
    Route::get('/tasks/{task_id}/alter_status/{status_id}', [TasksController::class, 'alter_status'])->name('tasks.alter_status');
});
