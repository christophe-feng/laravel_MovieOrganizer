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
}
