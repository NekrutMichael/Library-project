@extends('layouts.app')

@section('title', 'Адмін-панель: Книги')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Управління книгами</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Назва</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->BookID }}</td>
                    <td>{{ $book->Title ?? 'Без назви' }}</td> 
                    <td>
                        <a href="{{ route('admin.books.show', $book->BookID) }}" class="btn btn-info btn-sm">Перегляд</a>
                        
                        <form action="{{ route('admin.books.destroy', $book->BookID) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE') <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Точно видалити?')">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection