<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>609-32</title>
</head>
<body>
<h1>Список текстов</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Автор</th>
        <th>Оригинальный текст</th>
        <th>Модифицированный текст</th>
        <th>Токенов затрачено</th>
        <th>Действия</th>
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

</body>
</html>
