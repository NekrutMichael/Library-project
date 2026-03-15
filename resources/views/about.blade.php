@extends('layouts.app')

@section('title', 'Про проєкт')

@section('content')
    <div class="p-5 mb-4 bg-white rounded-3 shadow-sm border">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold text-primary">Про проєкт "Бібліотека"</h1>
            <p class="col-md-8 fs-4 mt-3">
                Це панель адміністратора для керування книжковим каталогом, розроблена на базі сучасного PHP-фреймворку Laravel.
            </p>
            <hr class="my-4">
            <p>
                Тут реалізовано повний цикл CRUD (створення, читання, оновлення, видалення) з підключенням до бази даних MySQL, а також система авторизації користувачів.
            </p>
            <a href="/" class="btn btn-outline-secondary btn-lg mt-3">Повернутися на головну</a>
        </div>
    </div>
@endsection