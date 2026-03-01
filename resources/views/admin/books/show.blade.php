@extends('layouts.app')

@section('title', 'Деталі книги: ' . $book->Title)

@section('content')
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Детальна інформація</h5>
            <span class="badge bg-secondary">ID: {{ $book->BookID }}</span>
        </div>
        
        <div class="card-body">
            <h2 class="card-title text-primary mb-4">{{ $book->Title }}</h2>
            
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item">
                    <strong>Рік видання:</strong> {{ $book->PublicationYear }}
                </li>
                <li class="list-group-item">
                    <strong>Доступно примірників:</strong> {{ $book->CopiesAvailable }} шт.
                </li>
                <li class="list-group-item">
                    <strong>Заставна вартість:</strong> {{ $book->CollateralValue }} грн
                </li>
                <li class="list-group-item">
                    <strong>Ціна оренди за день:</strong> {{ $book->DailyRentPrice }} грн
                </li>
                <li class="list-group-item">
                    <strong>ID жанру:</strong> {{ $book->GenreID }}
                </li>
            </ul>
            
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                &larr; Повернутися до списку
            </a>
        </div>
    </div>
@endsection