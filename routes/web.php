<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TextController;
use Symfony\Component\HttpKernel\Controller\ErrorController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello', function () {
    return view('hello', ['title' => 'Hello World']);
});

Route::get('/users', [UserController::class, 'index'])->name('users_index')->middleware('auth');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users_show')->middleware('auth');
Route::get('/texts', [TextController::class, 'index'])->name('texts_index')->middleware('auth');
Route::post('/texts', [TextController::class, 'store'])->name('texts_store')->middleware('auth');
Route::get('/texts/create', [TextController::class, 'create'])->name('texts_create')->middleware('auth');
Route::get('/texts/{id}', [TextController::class, 'show'])->name('texts_show')->middleware('auth');
Route::get('/texts/edit/{id}', [TextController::class, 'edit'])->middleware('auth');
Route::post('/texts/update/{id}', [TextController::class, 'update'])->middleware('auth');
Route::get('/texts/destroy/{id}', [TextController::class, 'destroy'])->middleware('auth');
Route::get('/error', function () {
    return view('error', ['message' => session('message')]);
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/auth', [LoginController::class, 'authenticate']);
