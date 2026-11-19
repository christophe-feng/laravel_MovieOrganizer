<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    /**
     * 允許欄位的白名單
     */
    protected $fillable = [
        'title',
        'director',
        'release_year',
        'genre_id',       // 改為外鍵 ID
        'rating',
        'description',
        'poster_path',
    ];

    /**
     * 欄位型態轉換
     */
    protected $casts = [
        'release_year' => 'integer',
        'rating' => 'float',
    ];

    /**
     * 每部電影屬於一個分類 (Inverse of One-to-Many)
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function getPosterUrlAttribute()
    {
        if (!$this->poster_path) {
            return null;
        }

        $baseUrl = request()->getSchemeAndHttpHost();

        // 1. 優先檢查是否為放在 public/images/ 裡的預設展示圖
        if (file_exists(public_path($this->poster_path))) {
            return $baseUrl . '/' . ltrim($this->poster_path, '/');
        }

        // 2. 否則讀取透過網頁表單動態上傳到 storage 的圖片
        return $baseUrl . '/storage/' . ltrim($this->poster_path, '/');
    }
}
