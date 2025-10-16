<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>609-32</title>
    </head>
<body>
    <h1>Текст {{ $text->id }}</h1>
    <p>Оригинальный текст: {{ $text->original_text }}</p>
    <p>Модифицированный текст: {{ $text->modified_text }}</p>
    <p>Токенов затрачено: {{ $text->used_tokens }}</p>
    <p>Автор: {{ $text->user->name}}</p>
</body>
</html>
