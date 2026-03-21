<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/books', [BookController::class, 'index']); //Повернення усіх книг
Route::get('/books/{id}', [BookController::class, 'show']); //Повернення конкретної книги
Route::post('/books/store', [BookController::class, 'store']);//Додавання нової книги (POST)
Route::put('/books/{id}', [BookController::class, 'update']);//Оновлення книги (PUT)
Route::delete('/books/{id}', [BookController::class, 'destroy']);//Видалення книги (DELETE)