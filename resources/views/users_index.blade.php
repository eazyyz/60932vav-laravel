<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>609-32</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Токены</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->tokens_balance }}</td>
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
