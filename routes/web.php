<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TextController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello', function () {
    return view('hello', ['title' => 'Hello World']);
});
Route::get('/users', [UserController::class, 'index'])->name('users_index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users_show');

Route::get('/texts', [TextController::class, 'index'])->name('texts_index');
Route::post('/texts', [TextController::class, 'store'])->name('texts_store');
Route::get('/texts/create', [TextController::class, 'create'])->name('texts_create');
Route::get('/texts/{id}', [TextController::class, 'show'])->name('texts_show');
Route::get('/texts/edit/{id}', [TextController::class, 'edit']);
Route::post('/texts/update/{id}', [TextController::class, 'update']);
Route::get('/texts/destroy/{id}', [TextController::class, 'destroy']);

