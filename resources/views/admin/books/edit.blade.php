@extends('adminlte::page')

@section('title', 'Редагувати книгу')

@section('content_header')
    <h1>Редагування книги: {{ $book->Title }}</h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Змініть необхідні дані</h3>
        </div>
        
        <form action="{{ route('admin.books.update', $book->BookID) }}" method="POST">
            @csrf
            @method('PUT') <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Увага! Помилка збереження:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="form-group">
                    <label for="Title">Назва книги *</label>
                    <input type="text" name="Title" id="Title" 
                           class="form-control @error('Title') is-invalid @enderror" 
                           value="{{ old('Title', $book->Title) }}">
                    @error('Title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="DailyRentPrice">Ціна оренди (грн/день) *</label>
                    <input type="number" step="0.01" name="DailyRentPrice" id="DailyRentPrice" 
                           class="form-control @error('DailyRentPrice') is-invalid @enderror" 
                           value="{{ old('DailyRentPrice', $book->DailyRentPrice) }}">
                    @error('DailyRentPrice') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="PublicationYear">Рік видання</label>
                    <input type="number" name="PublicationYear" id="PublicationYear" 
                           class="form-control" value="{{ old('PublicationYear', $book->PublicationYear) }}">
                </div>

                <div class="form-group">
                    <label for="CopiesAvailable">Доступно примірників</label>
                    <input type="number" name="CopiesAvailable" id="CopiesAvailable" 
                           class="form-control" value="{{ old('CopiesAvailable', $book->CopiesAvailable) }}">
                </div>

                <div class="form-group">
                    <label for="CollateralValue">Заставна вартість (грн)</label>
                    <input type="number" step="0.01" name="CollateralValue" id="CollateralValue" 
                           class="form-control" value="{{ old('CollateralValue', $book->CollateralValue) }}">
                </div>

                <div class="form-group">
                    <label for="GenreID">Жанр *</label>
                    <select name="GenreID" id="GenreID" class="form-control @error('GenreID') is-invalid @enderror">
                        @foreach($genres as $genre)
                            <option value="{{ $genre->GenreID }}" {{ old('GenreID', $book->GenreID) == $genre->GenreID ? 'selected' : '' }}>
                                {{ $genre->GenreName }} </option>
                        @endforeach
                    </select>
                    @error('GenreID') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-warning">Оновити дані</button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-default float-right">Скасувати</a>
            </div>
        </form>
    </div>
@stop