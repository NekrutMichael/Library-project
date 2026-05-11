<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;

// ==========================================
// Захищені маршрути (Потребують авторизації)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('/profile/loans', [ProfileController::class, 'loans']);
    Route::post('/rent', [LoanController::class, 'rentBooks']);
});

// ==========================================
// Публічні маршрути (Доступні гостям)
// ==========================================
Route::get('/genres', function() {
    return DB::table('genres')->select('GenreID', 'GenreName')->get();
});

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::post('/contact', [ContactMessageController::class, 'store']);

// Маршрути управління каталогом (CRUD)
Route::post('/books/store', [BookController::class, 'store']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);