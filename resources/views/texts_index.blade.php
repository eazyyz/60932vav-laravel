@extends('layout')
@section('content')
    <div class="container-fluid py-3">
        <h1 class="fw-bold">Список текстов</h1>
        <div class="table">
            <table class="table table-hover border">
                <thead class="table-light">
                <tr>
                    <th class="fw-semibold">ID</th>
                    <th class="fw-semibold">Автор</th>
                    <th class="fw-semibold">Оригинальный текст</th>
                    <th class="fw-semibold">Модифицированный текст</th>
                    <th class="fw-semibold">Токенов затрачено</th>
                    <th class="fw-semibold">Действия</th>
                </tr>
                </thead>
                <tbody>
    @foreach($texts as $text)
        <tr>
            <td>{{ $text->id }}</td>
            <td>{{ $text->user->name}}</td>
            <td>{{ $text->original_text}}</td>
            <td>{{ $text->modified_text}}</td>
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
{{ $texts->links() }}
@endsection
