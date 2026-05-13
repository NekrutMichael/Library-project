<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('authors', 'genre');

        if ($request->has('genre_id')) {
            $query->where('GenreID', $request->genre_id);
        }

        return response()->json($query->get());
    }

    public function show($id)
    {
        $book = Book::with('authors', 'genre')->where('BookID', $id)->firstOrFail();
        return response()->json($book);
    }

    public function store(Request $request)
    {
        $request->validate([
            'AuthorID' => 'nullable|integer',
            'NewAuthorFirstName' => 'nullable|string|max:255',
            'NewAuthorLastName' => 'nullable|string|max:255',
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string|max:3000',
            'DailyRentPrice' => 'required|numeric',
            'PublicationYear' => 'required|integer',
            'CopiesAvailable' => 'required|integer',
            'CollateralValue' => 'required|numeric',
            'GenreID' => 'required|integer',
            'Cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $authorId = $request->AuthorID;

        if ($request->filled('NewAuthorFirstName') && $request->filled('NewAuthorLastName')) {
            $author = Author::create([
                'FirstName' => $request->NewAuthorFirstName,
                'LastName' => $request->NewAuthorLastName
            ]);
            $authorId = $author->AuthorID;
        }

        $coverName = null;
        if ($request->hasFile('Cover')) {
            $file = $request->file('Cover');
            $coverName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('covers'), $coverName);
        }

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

        if ($authorId) {
            $book->authors()->attach($authorId);
        }

        return response()->json([
            'message' => 'Книгу успішно додано!',
            'data' => $book->load('authors')
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'AuthorID' => 'nullable|integer',
            'NewAuthorFirstName' => 'nullable|string|max:255',
            'NewAuthorLastName' => 'nullable|string|max:255',
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string|max:3000',
            'DailyRentPrice' => 'required|numeric',
            'PublicationYear' => 'required|integer',
            'CopiesAvailable' => 'required|integer',
            'CollateralValue' => 'required|numeric',
            'GenreID' => 'required|integer',
            'Cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $authorId = $request->AuthorID;

        if ($request->filled('NewAuthorFirstName') && $request->filled('NewAuthorLastName')) {
            $author = Author::create([
                'FirstName' => $request->NewAuthorFirstName,
                'LastName' => $request->NewAuthorLastName
            ]);
            $authorId = $author->AuthorID;
        }

        $coverName = $book->Cover;
        if ($request->hasFile('Cover')) {
            $file = $request->file('Cover');
            $coverName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('covers'), $coverName);
        }

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

        if ($authorId) {
            $book->authors()->sync([$authorId]);
        }

        return response()->json([
            'message' => 'Дані книги успішно оновлено!',
            'data' => $book->load('authors')
        ]);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->authors()->detach();
        $book->delete();

        return response()->json([
            'message' => 'Книгу успішно видалено з бази!'
        ]);
    }
}