@extends('layout')
@section('content')
@if($user)
    <div class="text-center">
        <h2>Здравствуйте, {{$user->name}}</h2>
        <a href="{{url('logout')}}">Выйти из системы</a>
    </div>
@else
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card shadow-sm border-1 rounded-3">
                <div class="card-body">
                    <h3 class="text-center">Войти в систему</h3>
                    <form method="post" action="{{url('auth')}}">
                        @csrf
                        <label class="mb-1">E-mail</label>
                        <input class="form-control" type="text" name="email" value="{{old('email')}}"/>
                        <br>
                        <label class="mb-1">Пароль</label>
                        <input class="form-control" type="password" name="password" value="{{old('password')}}">

                        <br>
                        <input class="btn btn-primary w-100" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
