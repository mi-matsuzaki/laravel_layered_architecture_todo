<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('todos.index'));

Route::resource('todos', TodoController::class);
Route::patch('todos/{id}/toggle', [TodoController::class, 'toggleStatus'])->name('todos.toggle');
