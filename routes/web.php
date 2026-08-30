<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// 首頁直接導向電影清單
Route::get('/', function () {
    return redirect()->route('movies.index');
});

// 註冊所有 Movie CRUD 路由
Route::resource('movies', MovieController::class);