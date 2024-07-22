<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::resource('projects', ProjectController::class);

Route::get('projects/{project}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('projects/{project}/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

