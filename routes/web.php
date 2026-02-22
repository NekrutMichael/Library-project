<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BookController;

Route::get('/', MainController::class);
Route::get('/about', AboutController::class);
Route::get('/books', [BookController::class, 'index']);      
Route::get('/books/{id}', [BookController::class, 'show']); 
