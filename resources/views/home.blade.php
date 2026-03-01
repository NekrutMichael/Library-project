@extends('layouts.app')

@section('title', 'Головна сторінка')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Вітаємо у нашій бібліотеці!</h1>
            <p class="col-md-8 fs-4">Тут ви знайдете найкращі книги для читання. Наша система дозволяє зручно переглядати каталог та знаходити потрібну літературу.</p>
           <a href="{{ route('admin.books.index') }}" class="btn btn-primary btn-lg">Перейти до каталогу</a>
        </div>
    </div>
@endsection