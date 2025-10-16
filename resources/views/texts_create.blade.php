<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>609-32</title>
</head>
<body>
    <h2>Добавление нового текста</h2>
    <form method="post" action="{{ url('texts') }}">
        @csrf
        <label>Оригинальный текст</label><br>
        <input type="text" name="original_text" value="{{ old('original_text') }}"/>
        @error('original_text')
        <div class="is-invalid" style="color:red;">{{ $message }}</div>
        @enderror
        <br>
        <label>Модифицированный текст</label><br>
        <input type="text" name="modified_text" value="{{ old('modified_text') }}"/>
        @error('modified_text')
        <div class="is-invalid" style="color:red;">{{ $message }}</div>
        @enderror
        <br>
        <label>Использованные токены</label><br>
        <input type="number" name="used_tokens" value="{{ old('used_tokens') }}"/>
        @error('used_tokens')
        <div class="is-invalid" style="color:red;">{{ $message }}</div>
        @enderror
        <br>
        <label>Автор</label><br>
        <select name="user_id">
            <option style="display:none" value="">Выберите пользователя</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}"
                        @if(old('user_id') == $user->id)
                            selected
                    @endif>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('user_id')
        <div class="is-invalid" style="color:red;">{{ $message }}</div>
        @enderror
        <br>
        <input type="submit" value="Добавить">
    </form>
</body>
</html>

