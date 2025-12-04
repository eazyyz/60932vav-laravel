@extends('layout')
@section('content')
    <div class="container py-3">
        <div class="col-lg-8 mx-auto">
            <h2 class="mb-4 text-center">Добавление нового текста</h2>
            <form method="post" action="{{ url('texts') }}">
                @csrf
                <div class="mb-3">
                    <label for="original_text" class="form-label">Оригинальный текст</label>
                    <input type="text" class="form-control @error('original_text') is-invalid @enderror"
                           id="original_text" name="original_text" value="{{ old('original_text') }}"/>
                    @error('original_text')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="modified_text" class="form-label">Модифицированный текст</label>
                    <input type="text" class="form-control @error('modified_text') is-invalid @enderror"
                           id="modified_text" name="modified_text" value="{{ old('modified_text') }}"/>
                    @error('modified_text')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="used_tokens" class="form-label">Использованные токены</label>
                    <input type="number" class="form-control @error('used_tokens') is-invalid @enderror"
                           id="used_tokens" name="used_tokens" value="{{ old('used_tokens') }}"/>
                    @error('used_tokens')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="user_id" class="form-label">Автор</label>
                    <select class="form-select @error('user_id') is-invalid @enderror"
                            id="user_id" name="user_id">
                        <option value="">Выберите пользователя</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                    @if(old('user_id') == $user->id) selected @endif>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Добавить</button>
                <a href="{{ route('texts_index') }}" class="btn btn-secondary">Отмена</a>
            </form>
        </div>
    </div>
@endsection
