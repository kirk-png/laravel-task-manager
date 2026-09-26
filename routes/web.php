<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/tasks');

// Full CRUD (index, create, store, edit, update, destroy) for tasks
Route::resource('tasks', TaskController::class);

// Dedicated route for quickly updating a task's status
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
