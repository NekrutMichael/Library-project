<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book; 

class BookController extends Controller
{
    public function index()
    {
        $book = Book::all();
        return response()->json($book);
    }
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'DailyRentPrice' => 'required|numeric',
            'PublicationYear' => 'required|integer',
            'CopiesAvailable' => 'required|integer',
            'CollateralValue' => 'required|numeric',
            'GenreID' => 'required|integer'
        ]);
        $book = Book::create($validated);
        return response()->json([
            'message' => 'Книгу успішно додано!',
            'data' => $book
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'DailyRentPrice' => 'required|numeric',
            'PublicationYear' => 'required|integer',
            'CopiesAvailable' => 'required|integer',
            'CollateralValue' => 'required|numeric',
            'GenreID' => 'required|integer'
        ]);
        $book->update($validated);
        return response()->json([
            'message' => 'Дані книги успішно оновлено!',
            'data' => $book
        ]);
    }
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json([
            'message' => 'Книгу успішно видалено з бази!'
        ]);
    }
}
