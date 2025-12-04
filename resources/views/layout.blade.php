<!doctype html>
<html Lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>609-32</title>

</head>
<body class="d-flex flex-column h-100">
<header>
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container-fluid col-10">
            <a class="navbar-brand d-flex align-items-center fw-bold fs-5 text-primary " href="{{ url('/') }}">
                <span class="me-2" style="font-size:1.5rem;">😆</span>
                EmojifyText
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                    aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-lg-flex justify-content-end align-items-center" id="navbarMenu">
                <ul class="navbar-nav mb-2 mb-lg-0 gap-lg-4">
                    @can('view-users')
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('texts_create') }}">Создать текст</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('texts_index') }}">Текста</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('users_index') }}">Пользователи</a>
                        </li>
                    @endcan
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-secondary"
                               href="{{ route('users_show', ['id' => auth()->user()->id]) }}">Профиль</a>
                        </li>
                    @endauth

                </ul>
                <!-- правая часть -->
                <ul class="navbar-nav ms-lg-3">
                    @auth
                        <li class="nav-item">
                            <a class="btn btn-outline-primary btn-sm" href="{{ url('logout') }}">Выйти</a>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Войти</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container-fluid col-10">

    @include('error')
    @section ('content')
    @show
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
