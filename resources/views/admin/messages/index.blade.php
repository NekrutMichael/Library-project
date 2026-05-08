@extends('adminlte::page')

@section('title', 'Повідомлення з сайту')

@section('content_header')
    <h1>Повідомлення з сайту</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px">ID</th>
                        <th style="width: 200px">Ім'я</th>
                        <th style="width: 200px">Email</th>
                        <th>Текст повідомлення</th>
                        <th style="width: 150px">Дата</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                        <tr>
                            <td>{{ $message->id }}</td>
                            <td><strong>{{ $message->name }}</strong></td>
                            <td><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Немає нових повідомлень</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop