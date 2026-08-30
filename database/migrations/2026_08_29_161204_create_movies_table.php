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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');                           // 電影名稱
            $table->string('director')->nullable();            // 導演（可為空）
            $table->unsignedSmallInteger('release_year');      // 上映年份 (例如: 2024)
            $table->string('genre')->default('未分類');         // 電影類型（第一階段先用字串存）
            $table->decimal('rating', 3, 1)->default(0.0);     // 評分 (例如: 8.5，範圍 0.0 ~ 10.0)
            $table->text('description')->nullable();           // 劇情簡介
            $table->string('poster_path')->nullable();         // 海報圖片存檔路徑
            $table->timestamps();                              // created_at 與 updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
