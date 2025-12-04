@extends('layout')
@section('content')
    <div class="container-fluid py-3">
        <h1 class="fw-bold">Пользователи</h1>
        <div class="table">
            <table class="table table-hover border">
                <thead class="table-light">
                <tr>
                    <th class="fw-semibold">ID</th>
                    <th class="fw-semibold">Имя</th>
                    <th class="fw-semibold">Email</th>
                    <th class="fw-semibold">Токены</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->tokens_balance }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
