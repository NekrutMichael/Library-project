@extends('adminlte::page')
@section('title', 'Додати книгу')
@section('content_header')
    <h1>Додавання нової книги</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Заповніть форму</h3>
    </div>
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="Title">Назва книги *</label>
                <input type="text" name="Title" id="Title" class="form-control @error('Title') is-invalid @enderror" value="{{ old('Title') }}">
                @error('Title') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="AuthorID">Оберіть автора</label>
                <select name="AuthorID" id="AuthorID" class="form-control">
                    <option value="">-- Оберіть автора --</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->AuthorID }}">{{ $author->FirstName }} {{ $author->LastName }}</option>
                    @endforeach
                </select>
            </div>

                <div class="form-group">
                    <label for="NewAuthor">Або додайте нового автора</label>
                    <input type="text" name="NewAuthorFirstName" id="NewAuthorFirstName" class="form-control" placeholder="Ім'я">
                    <input type="text" name="NewAuthorLastName" id="NewAuthorLastName" class="form-control mt-2" placeholder="Прізвище">
                </div>

            <div class="form-group">
                <label for="Description">Опис книги</label>
                <textarea name="Description" id="Description" rows="5" class="form-control @error('Description') is-invalid @enderror">{{ old('Description') }}</textarea>
                @error('Description') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="Cover">Обкладинка книги</label>
                <input type="file" name="Cover" id="Cover" class="form-control-file @error('Cover') is-invalid @enderror">
                @error('Cover') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="DailyRentPrice">Ціна оренди (грн/день) *</label>
                <input type="number" step="0.01" name="DailyRentPrice" id="DailyRentPrice" class="form-control @error('DailyRentPrice') is-invalid @enderror" value="{{ old('DailyRentPrice') }}">
                @error('DailyRentPrice') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="PublicationYear">Рік видання</label>
                <input type="number" name="PublicationYear" id="PublicationYear" class="form-control" value="{{ old('PublicationYear') ?? date('Y') }}">
            </div>

            <div class="form-group">
                <label for="CopiesAvailable">Доступно примірників</label>
                <input type="number" name="CopiesAvailable" id="CopiesAvailable" class="form-control" value="{{ old('CopiesAvailable') ?? 1 }}">
            </div>

            <div class="form-group">
                <label for="CollateralValue">Заставна вартість (грн)</label>
                <input type="number" step="0.01" name="CollateralValue" id="CollateralValue" class="form-control" value="{{ old('CollateralValue') ?? 0 }}">
            </div>

            <div class="form-group">
                <label for="GenreID">Жанр *</label>
                <select name="GenreID" id="GenreID" class="form-control @error('GenreID') is-invalid @enderror">
                    <option value="">-- Оберіть жанр --</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->GenreID }}" {{ old('GenreID') == $genre->GenreID ? 'selected' : '' }}>{{ $genre->GenreName }}</option>
                    @endforeach
                </select>
                @error('GenreID') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Зберегти книгу</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-default float-right">Скасувати</a>
        </div>
    </form>
</div>
@stop