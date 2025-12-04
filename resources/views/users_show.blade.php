@extends('layout')
@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-end">
            <div>
                <p class="mb-2"><strong>Пользователь:</strong> {{ $user->name }}</p>
                <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
            </div>
            <p class="mb-2" class="text-end"><strong>Баланс токенов:</strong> {{ $user->tokens_balance }}</p>
        </div>
        @can('view-users')
            <h1 class="fw-bold mt-1 mb-3">Текста пользователя</h1>
        @endcan
        @cannot('view-users')
            <h2 class="fw-bold mt-1 mb-3">Ваши текста</h2>
        @endcan
        <div class="table">
            <table class="table table-hover border">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Оригинальный текст</th>
                    <th>Модифицированный текст</th>
                    <th>Токенов затрачено</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->texts as $text)
                    <tr>
                        <td>{{ $text->id }}</td>
                        <td>{{ $text->original_text }}</td>
                        <td>{{ $text->modified_text }}</td>
                        <td>{{ $text->used_tokens }}</td>
                        <td>
                            <a href="{{ url('texts/edit/'.$text->id) }}">Редактировать</a> |
                            <a href="{{ url('texts/destroy/'.$text->id) }}">Удалить</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
