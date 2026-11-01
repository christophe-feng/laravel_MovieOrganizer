<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = ['動作', '科幻', '喜劇', '愛情', '懸疑', '恐怖', '動畫', '紀錄片'];

        foreach ($genres as $name) {
            Genre::firstOrCreate(['name' => $name]);
        }
    }
}