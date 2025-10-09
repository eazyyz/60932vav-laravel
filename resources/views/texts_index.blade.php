<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>texts</title>
</head>
<body>
<h1>Список текстов</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Автор</th>
        <th>Оригинал</th>
        <th>Эмодзи текст</th>
        <th>Токенов затрачено</th>
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
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
