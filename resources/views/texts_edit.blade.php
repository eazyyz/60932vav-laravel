<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>609-32</title>
    <style> .is-invalid { color: red; } </style>
</head>
<body>
<h2>Редактирование текста</h2>
<form method="post" action="{{ url('texts/update/'.$text->id) }}">
    @csrf
    <label>Оригинальный текст</label>
    <input type="text" name="original_text"
           value="@if(old('original_text')) {{ old('original_text') }} @else {{ $text->original_text }} @endif" />
    @error('original_text')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Модифицированный текст</label>
    <input type="text" name="modified_text"
           value="@if(old('modified_text')) {{ old('modified_text') }} @else {{ $text->modified_text }} @endif" />
    @error('modified_text')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Использованные токены</label>
    <input type="text" name="used_tokens"
           value="@if(old('used_tokens')) {{ old('used_tokens') }} @else {{ $text->used_tokens }} @endif" />
    @error('used_tokens')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Автор</label>
    <select name="user_id" value="{{ old('user_id') }}">
        <option style="display:none">-- выберите пользователя --</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}"
                    @if(old('user_id'))
                        @if(old('user_id') == $user->id) selected @endif
                    @else
                        @if($text->user_id == $user->id) selected @endif
                @endif>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
    @error('user_id')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <input type="submit" value="Сохранить">
</form>
</body>
</html>
