<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }
    public function show(Book $book) 
    {
        return view('admin.books.show', compact('book'));
    }
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Книгу успішно видалено!');
    }

    public function create() {
        return view('admin.books.create');
    }
    public function store(Request $request) {$validated = $request->validate([
            'Title' => 'required|string|max:255',
            'DailyRentPrice' => 'required|numeric|gt:0',
            'PublicationYear' => 'required|integer',
            'CopiesAvailable' => 'required|integer|min:0',
            'CollateralValue' => 'required|numeric|min:0',
            'GenreID' => 'required|integer'
        ], [
            'Title.required' => 'Поле "Назва" є обов\'язковим.',
            'DailyRentPrice.required' => 'Вкажіть ціну оренди.',
            'DailyRentPrice.gt' => 'Ціна оренди має бути строго більшою за нуль.',
        ]);
        Book::create($validated);
        return redirect()->route('admin.books.index')
                         ->with('success', 'Нову книгу успішно додано до каталогу!');}
    public function edit(Book $book) {}
    public function update(Request $request, Book $book) {}
}