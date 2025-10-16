<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>609-32</title>
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
            <th>Оригинальный текст</th>
            <th>Модифицированный текст</th>
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
