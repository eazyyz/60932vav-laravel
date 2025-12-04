@extends('layout')
@section('content')
    <div class="container py-5">
        <div class="col-lg-8 mx-auto">
            <h2 class="mb-3">Текст № {{ $text->id }}</h2>
            <div class="row mb-4">
                <div class="col">
                    <p class="text-muted  mb-1">Автор</p>
                    <p class="fs-5">{{ $text->user->name }}</p>
                </div>
                <div class="col text-md-end">
                    <p class="text-muted  mb-1">Токены</p>
                    <p class="fs-5">{{ $text->used_tokens }}</p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-6">
                    <p class="text-muted mb-2">Оригинальный текст</p>
                    <div class="card shadow-sm p-4 rounded" style="min-height: 200px;">
                        <p>{{ $text->original_text }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-2">Модифицированный текст</p>
                    <div class="card shadow-sm bg-light p-4 rounded" style="min-height: 200px;">
                        <p>{{ $text->modified_text }}</p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('texts_index') }}" class="btn btn-secondary">Назад</a>
                <div class="gap-2 d-flex">
                    <a href="{{ url('texts/edit/'.$text->id) }}" class="btn btn-primary">Редактировать</a>
                    <a href="{{ url('texts/destroy/'.$text->id) }}" class="btn btn-danger">Удалить</a>
                </div>
            </div>
        </div>
    </div>
@endsection
