<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. 首頁直接導向電影清單
Route::get('/', function () {
    return redirect()->route('movies.index');
});

// 2. 公開路由（訪客與會員皆可瀏覽）
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

// 3. 需登入才能操作的後台功能 (新增、編輯、刪除、分類管理)
Route::middleware(['auth'])->group(function () {
    // 電影的寫入與異動操作
    Route::resource('movies', MovieController::class)->except(['index', 'show']);

    // 分類管理（全部操作皆需登入）
    Route::resource('genres', GenreController::class)->except(['create', 'show', 'edit']);

    // Breeze 內建的個人資料管理
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
