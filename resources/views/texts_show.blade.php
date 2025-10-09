<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Текст {{ $text->id }}</title>
    </head>
<body>
    <h1>Текст {{ $text->id }}</h1>
    <p>Оригинал: {{ $text->original_text }}</p>
    <p>Эмодзи текст: {{ $text->modified_text }}</p>
    <p>Токенов затрачено: {{ $text->used_tokens }}</p>
    <p>Автор: {{ $text->user->name}}</p>
</body>
</html>
