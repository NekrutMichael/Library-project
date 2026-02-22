@extends('layouts.app')

@section('title', 'Каталог книг')

@section('content')
    <h2 class="mb-4">Доступні книги</h2>
    
    <div class="list-group">
        @foreach($books as $id => $title)
            <a href="/books/{{ $id }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                {{ $title }}
                <span class="badge bg-primary rounded-pill">Деталі</span>
            </a>
        @endforeach
    </div>
@endsection