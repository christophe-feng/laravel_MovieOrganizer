<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            // 建立外鍵 genre_id，並關聯至 genres 資料表的 id 欄位
            // nullOnDelete() 代表若分類被刪除，電影的 genre_id 會設為 NULL，避免連帶誤刪電影
            $table->foreignId('genre_id')
                ->nullable()
                ->after('title')
                ->constrained('genres')
                ->nullOnDelete();

            // 移除舊的字串欄位（可選）
            if (Schema::hasColumn('movies', 'genre')) {
                $table->dropColumn('genre');
            }
        });
    }

    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
            $table->dropColumn('genre_id');
            $table->string('genre')->nullable();
        });
    }
};
