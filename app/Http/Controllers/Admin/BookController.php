<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('authors')->get();
        return view('admin.books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with('authors')->findOrFail($id);
        return view('admin.books.show', compact('book'));
    }

    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();
        return view('admin.books.create', compact('genres', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'AuthorID' => 'nullable|integer',
            'NewAuthorFirstName' => 'nullable|string|max:255',
            'NewAuthorLastName' => 'nullable|string|max:255',
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string|max:3000',
            'Cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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

        // Логіка автора
        $authorId = $request->AuthorID;
        if ($request->filled('NewAuthorFirstName') && $request->filled('NewAuthorLastName')) {
            $author = Author::create([
                'FirstName' => $request->NewAuthorFirstName,
                'LastName' => $request->NewAuthorLastName
            ]);
            $authorId = $author->AuthorID;
        }

        // Логіка обкладинки
        $coverName = null;
        if ($request->hasFile('Cover')) {
            $file = $request->file('Cover');
            $coverName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('covers'), $coverName);
        }

        // Створення книги
        $book = Book::create([
            'Title' => $request->Title,
            'Description' => $request->Description,
            'Cover' => $coverName,
            'DailyRentPrice' => $request->DailyRentPrice,
            'PublicationYear' => $request->PublicationYear,
            'CopiesAvailable' => $request->CopiesAvailable,
            'CollateralValue' => $request->CollateralValue,
            'GenreID' => $request->GenreID
        ]);

        // Прив’язка автора через Many-to-Many
        if ($authorId) {
            $book->authors()->attach($authorId);
        }

        return redirect()->route('admin.books.index')->with('success', 'Нову книгу успішно додано до каталогу!');
    }

    public function edit($id)
    {
        $genres = Genre::all();
        $authors = Author::all();
        $book = Book::with('authors')->findOrFail($id);
        return view('admin.books.edit', compact('book', 'genres', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'AuthorID' => 'nullable|integer',
            'NewAuthorFirstName' => 'nullable|string|max:255',
            'NewAuthorLastName' => 'nullable|string|max:255',
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string|max:3000',
            'Cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'DailyRentPrice' => 'required|numeric|gt:0',
            'PublicationYear' => 'required|integer',
            'CopiesAvailable' => 'required|integer|min:0',
            'CollateralValue' => 'required|numeric|min:0',
            'GenreID' => 'required|integer'
        ]);

        // Оновлення або створення автора
        $authorId = $request->AuthorID;
        if ($request->filled('NewAuthorFirstName') && $request->filled('NewAuthorLastName')) {
            $author = Author::create([
                'FirstName' => $request->NewAuthorFirstName,
                'LastName' => $request->NewAuthorLastName
            ]);
            $authorId = $author->AuthorID;
        }

        // Оновлення обкладинки
        $coverName = $book->Cover;
        if ($request->hasFile('Cover')) {
            $file = $request->file('Cover');
            $coverName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('covers'), $coverName);
        }

        // Оновлення основних даних
        $book->update([
            'Title' => $request->Title,
            'Description' => $request->Description,
            'Cover' => $coverName,
            'DailyRentPrice' => $request->DailyRentPrice,
            'PublicationYear' => $request->PublicationYear,
            'CopiesAvailable' => $request->CopiesAvailable,
            'CollateralValue' => $request->CollateralValue,
            'GenreID' => $request->GenreID
        ]);

        // Синхронізація зв’язку Many-to-Many
        if ($authorId) {
            $book->authors()->sync([$authorId]);
        }

        return redirect()->route('admin.books.index')->with('success', 'Дані книги успішно оновлено!');
    }

    public function destroy(Book $book)
    {
        $book->authors()->detach(); // Видаляємо зв'язки в проміжній таблиці
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Книгу успішно видалено!');
    }
}