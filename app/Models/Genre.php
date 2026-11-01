<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * 一個分類包含多部電影 (One-to-Many)
     */
    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class);
    }
}