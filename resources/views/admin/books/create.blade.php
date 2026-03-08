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
        
        <form action="{{ route('admin.books.store') }}" method="POST">
            @csrf <div class="card-body">
                
                <div class="form-group">
                    <label for="Title">Назва книги *</label>
                    <input type="text" name="Title" id="Title" 
                           class="form-control @error('Title') is-invalid @enderror" 
                           value="{{ old('Title') }}">
                    @error('Title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="DailyRentPrice">Ціна оренди (грн/день) *</label>
                    <input type="number" step="0.01" name="DailyRentPrice" id="DailyRentPrice" 
                           class="form-control @error('DailyRentPrice') is-invalid @enderror" 
                           value="{{ old('DailyRentPrice') }}">
                    @error('DailyRentPrice')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="PublicationYear">Рік видання</label>
                    <input type="number" name="PublicationYear" id="PublicationYear" 
                           class="form-control @error('PublicationYear') is-invalid @enderror" 
                           value="{{ old('PublicationYear') ?? date('Y') }}">
                    @error('PublicationYear')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="CopiesAvailable">Доступно примірників</label>
                    <input type="number" name="CopiesAvailable" id="CopiesAvailable" 
                           class="form-control" value="{{ old('CopiesAvailable') ?? 1 }}">
                </div>

                <div class="form-group">
                    <label for="CollateralValue">Заставна вартість (грн)</label>
                    <input type="number" step="0.01" name="CollateralValue" id="CollateralValue" 
                           class="form-control" value="{{ old('CollateralValue') ?? 0 }}">
                </div>

                <div class="form-group">
                    <label for="GenreID">Жанр *</label>
                     <select name="GenreID" id="GenreID" class="form-control">
                     <option value="1">Трилер</option>
                     <option value="2">Роман</option>
                     <option value="3">Вестерн</option>
                     <option value="4">Філософія</option>
                     <option value="5">Манга/Комікси</option>
                     <option value="6">Жахи</option>
                    </select>
                </div>

            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Зберегти книгу</button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-default float-right">Скасувати</a>
            </div>
        </form>
    </div>
@stop