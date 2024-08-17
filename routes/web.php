<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GroupController;
use App\Http\Controllers\TodoController;

Route::resource('groups', GroupController::class);
Route::resource('todos', TodoController::class)->except(['index', 'show', 'edit', 'create']);
Route::post('todos/{todo}/toggle-complete', [TodoController::class, 'toggleComplete'])->name('todos.toggleComplete');
Route::get('/', [GroupController::class, 'index']);


