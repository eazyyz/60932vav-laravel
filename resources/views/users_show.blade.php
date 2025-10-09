<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Пользователь {{ $user->name }}</title>
    </head>
<body>
    <p>Пользователь: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Баланс токенов: {{ $user->tokens_balance }}</p>
    <h2>Тексты пользователя</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Оригинал</th>
            <th>Эмодзи текст</th>
            <th>Токенов затрачено</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user->texts as $text)
            <tr>
                <td>{{ $text->id }}</td>
                <td>{{ $text->original_text }}</td>
                <td>{{ $text->modified_text }}</td>
                <td>{{ $text->used_tokens }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
