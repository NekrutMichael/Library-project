<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\BookController as AdminBookController;

Route::get('/', MainController::class);
Route::get('/about', AboutController::class);
Route::get('/books', [BookController::class, 'index']);      
Route::get('/books/{id}', [BookController::class, 'show']); 
Route::prefix('admin')->name('admin.')->group(function () {
Route::resource('books', AdminBookController::class);
});