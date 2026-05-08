<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Genre;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }
    public function show($id) 
    {
        $book = \App\Models\Book::findOrFail($id);
        return view('admin.books.show', compact('book'));
    }
    public function destroy(Book $book)
    {
        \App\Models\Book::findOrFail($id)->delete();
        return redirect()->route('admin.books.index')->with('success', 'Книгу успішно видалено!');
    }

    public function create() {
        $genres = \App\Models\Genre::all();
        return view('admin.books.create', compact('genres'));
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
    public function edit($id) {
        $genres = \App\Models\Genre::all();
        $book = \App\Models\Book::findOrFail($id);
        return view('admin.books.edit', compact('book', 'genres'));
    }
    public function update(Request $request, Book $book) {
        $validator = validator($request->all(), [
            'Title' => 'required|string|max:255',
            'DailyRentPrice' => 'required|numeric|gt:0',
            'PublicationYear' => 'required|integer',
            'CopiesAvailable' => 'required|integer|min:0',
            'CollateralValue' => 'required|numeric|min:0',
            'GenreID' => 'required|integer'
        ]);
        if ($validator->fails()) {
            dd('🚨 ЗЛОВИЛИ ПОМИЛКУ ВАЛІДАЦІЇ:', $validator->errors()->toArray());
        }
        $book->update($validator->validated());
        return redirect()->route('admin.books.index')
                         ->with('success', 'Дані книги успішно оновлено!');
    }
}