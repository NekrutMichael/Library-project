<?php

use App\Http\Controllers\Admin\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactMessageController;

Route::get('/', function () {
    return redirect()->route('admin.books.index');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('admin.books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('admin.books.create');
    Route::get('/messages', [ContactMessageController::class, 'index'])->name('admin.messages.index');
    Route::post('/books', [BookController::class, 'store'])->name('admin.books.store');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('admin.books.show');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('admin.books.destroy');
});

require __DIR__.'/auth.php';