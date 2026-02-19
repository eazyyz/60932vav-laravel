<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TextControllerAPI;
use App\Http\Controllers\UserControllerAPI;
use App\Http\Controllers\TokenControllerAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

//Route:: get('/texts', [TextControllerAPI::class, 'index']);
//Route::get('/texts/{id}', [TextControllerAPI::class, 'show']);

Route:: get('/users', [UserControllerAPI::class, 'index']);
Route::get('/users/{id}', [UserControllerAPI::class, 'show']);

Route:: get('/tokens', [TokenControllerAPI::class, 'index']);
Route::get('/tokens/{id}', [TokenControllerAPI::class, 'show']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::middleware('auth:sanctum')->get('/texts', [TextControllerAPI::class, 'index']);
    Route::middleware('auth:sanctum')->get('/texts/{id}', [TextControllerAPI::class, 'show']);
    Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
        return $request->user();
    });
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});
