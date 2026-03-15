@extends('adminlte::page')

@section('title', 'Книги')

@section('content_header')
    <h1>Управління книгами</h1>
@stop

@section('content')
    @if(session('success'))
            <div class="alert alert-success mt-3 alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <h5><i class="icon fas fa-check"></i> Успіх!</h5>
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-3">
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Додати нову книгу
        </a>
    </div>
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
                        <a href="{{ route('admin.books.edit', $book->BookID) }}" class="btn btn-warning btn-sm">Редагувати</a>
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