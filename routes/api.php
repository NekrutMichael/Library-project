<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Models\Genre;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/profile/loans', [ProfileController::class, 'loans']); //Повернення історії оренди користувача (GET)
Route::middleware('auth:sanctum')->post('/rent', [LoanController::class, 'rentBooks']); //Оренда книг (POST)

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/genres', function() {
return DB::table('genres')->select('GenreID', 'GenreName')->get();
});

Route::get('/books', [BookController::class, 'index']); //Повернення усіх книг
Route::get('/books/{id}', [BookController::class, 'show']); //Повернення конкретної книги
Route::post('/books/store', [BookController::class, 'store']);//Додавання нової книги (POST)
Route::post('/contact', [ContactMessageController::class, 'store']);//Додавання нового повідомлення (POST)
Route::put('/books/{id}', [BookController::class, 'update']);//Оновлення книги (PUT)
Route::delete('/books/{id}', [BookController::class, 'destroy']);//Видалення книги (DELETE)
