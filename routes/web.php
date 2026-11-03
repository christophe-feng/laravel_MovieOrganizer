<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

// 首頁直接導向電影清單
Route::get('/', function () {
    return redirect()->route('movies.index');
});

// 註冊所有 Movie CRUD 路由
Route::resource('movies', MovieController::class);

// 註冊所有 Genre CRUD 路由
Route::get('/', function () {
    return redirect()->route('movies.index');
});

Route::resource('movies', MovieController::class);
Route::resource('genres', GenreController::class)->except(['create', 'show', 'edit']);