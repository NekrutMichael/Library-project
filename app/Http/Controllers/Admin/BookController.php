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

    public function create() {}
    public function store(Request $request) {}
    public function edit(Book $book) {}
    public function update(Request $request, Book $book) {}
}