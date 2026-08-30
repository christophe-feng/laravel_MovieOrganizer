<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * 允許欄位的白名單
     */
    protected $fillable = [
        'title',
        'director',
        'release_year',
        'genre',
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
}
