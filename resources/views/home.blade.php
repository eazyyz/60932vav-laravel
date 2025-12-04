{{--
    когда вызывается error почему то меняется колонки или типо того на всех кроме home +

    осталось подкрутить то, чтобы пользователь не мог перевести текст в эмодзи до входа в аккаунт +

    прикрутить дипсик опенроутер: +
    пока не придет ответ с апи кнопку нельзя нажимать +
    пока не придет ответ с апи идёт лоадер +
    после того как пришел ответ с апи считается token_transaction и вычитается сразу же с баланса юзера +

    и чтобы некоторые элементы не отображались обычному пользовоталею, а админу - показывались:
        хедер - пользователи, создать текст +
        в текстах должно показываться только текста пользователя +

    стили таблиц юзершоу и текстиндекс должны быть одинаковыми +
    и их колонки тоже +

    запретить обычному пользователю просмотр всех текстов +
    --}}
@extends('layout')
@section('content')

    @guest
        <p class="text-center mb-0 mt-3">Чтобы воспользоваться нашим сервисом <a
                href="{{ route('login') }}">авторизуйтесь</a>.
        </p>
    @endguest

    <div class="container col-lg-10 py-2">
        <p class="text-center mb-3 fs-3">Используйте наш сервис для добавления в текст ярких эмодзи</p>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="mt-2 fs-5 d-flex justify-content-between flex-wrap gap-3">
                @if(auth()->check())
                    <p>Ваши токены: {{ $balance }}</p>
                @endif
                <p>Будет потрачено токенов: <span
                        id="token-count">0</span></p>
            </div>

            <form method="POST" action="{{ route('texts_store') }}">
                @csrf
                <div class="row g-2">
                    <!-- Левая карточка -->
                    <div class="col-lg-6">
                        <div class="card shadow-sm border-1 rounded-3">
                            <div class="card-body">
                                <label class="form-label fw-semibold mb-3 fs-5">Ваш текст</label>
                                <textarea class="form-control"
                                          name="original_text"
                                          id="original_text"
                                          rows="8"
                                          placeholder="Введите текст сюда..."
                                          style="resize: none;">{{ session('original_text', '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Правая карточка -->
                    <div class="col-lg-6">
                        <div class="card shadow-sm border-1 rounded-3">
                            <div class="card-body">
                                <label class="form-label fw-semibold mb-3 fs-5">Перевод эмодзи</label>
                                <textarea class="form-control"
                                          id="modified_text"
                                          rows="8"
                                          placeholder="Результат появится здесь..."
                                          readonly
                                          style="resize: none;">{{ session('modified_text', '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Кнопка -->
                <div class="text-center mt-4">
                    @auth
                        <button type="submit" id="emojify-btn" class="btn btn-primary px-5 py-2 rounded-3 fw-semibold">
                            <span id="btn-text">Перевести в эмодзи</span>
                            <span id="loading-text" style="display: none;">Загрузка<span id="dots"></span></span>
                        </button>
                    @else
                        <button type="button" class="btn btn-primary px-5 py-2 rounded-3 fw-semibold" disabled>
                            Перевести в эмодзи
                        </button>
                    @endauth
                </div>

            </form>
        </div>
    </div>
    <script>
        document.getElementById('original_text').addEventListener('input', function () {
            const words = this.value.trim().split(/\s+/).filter(w => w);
            document.getElementById('token-count').textContent = words.length;
        });

        document.querySelector('form')?.addEventListener('submit', function (e) {
            const btnText = document.getElementById('btn-text');
            const loadingText = document.getElementById('loading-text');
            const dots = document.getElementById('dots');

            btnText.style.display = 'none';
            loadingText.style.display = 'inline';

            let dotCount = 0;
            const interval = setInterval(() => {
                dots.textContent = '.'.repeat(++dotCount % 4);
            }, 500);
        });
    </script>

@endsection
