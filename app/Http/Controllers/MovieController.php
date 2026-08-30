<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
// 用Storage就能處理各類型的檔案儲存
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * 列表頁：讀取電影清單並依最新建立時間分頁
     */
    public function index()
    {
        // 每頁顯示 6 筆，並依建立時間降冪排序
        $movies = Movie::latest()->paginate(6);

        return view('movies.index', compact('movies'));
    }

    /**
     * 表單頁：顯示新增電影的頁面
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * 動作：處理新增電影表單送出（含驗證與圖片上傳）
     */
    public function store(Request $request)
    {
        // 1. 資料驗證
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'director'     => 'nullable|string|max:255',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'genre'        => 'nullable|string|max:100',
            'rating'       => 'nullable|numeric|min:0|max:10',
            'description'  => 'nullable|string',
            'poster'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 最大 2MB
        ], [
            'title.required'        => '請填寫電影名稱',
            'release_year.required' => '請填寫上映年份',
            'poster.image'          => '檔案必須是圖片格式',
            'poster.mimes'          => '請上傳正確的圖片檔案格式 (jpeg, png, jpg, webp)',
            'poster.max'            => '海報圖片大小不能超過 2MB',
        ]);

        // 2. 處理圖片上傳
        if ($request->hasFile('poster')) {
            // 存入 storage/app/public/posters 目錄，並取得相對路徑
            $path = $request->file('poster')->store('posters', 'public');
            $validated['poster_path'] = $path;
        }

        // 3. 寫入資料庫
        Movie::create($validated);

        return redirect()->route('movies.index')
            ->with('success', '電影「' . $validated['title'] . '」新增成功！');
    }

    /**
     * 詳情頁：查看單一電影詳情（可選）
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * 表單頁：顯示編輯電影頁面
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
     * 動作：處理編輯更新（含替換/移除舊圖片）
     */
    public function update(Request $request, Movie $movie)
    {
        // 1. 資料驗證
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'director'     => 'nullable|string|max:255',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'genre'        => 'nullable|string|max:100',
            'rating'       => 'nullable|numeric|min:0|max:10',
            'description'  => 'nullable|string',
            'poster'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. 若有上傳新海報，刪除舊圖並儲存新圖
        if ($request->hasFile('poster')) {
            if ($movie->poster_path && Storage::disk('public')->exists($movie->poster_path)) {
                Storage::disk('public')->delete($movie->poster_path);
            }

            $path = $request->file('poster')->store('posters', 'public');
            $validated['poster_path'] = $path;
        }

        // 3. 更新資料庫
        $movie->update($validated);

        return redirect()->route('movies.index')
            ->with('success', '電影「' . $movie->title . '」已更新完成！');
    }

    /**
     * 動作：刪除電影（同時移除海報圖檔）
     */
    public function destroy(Movie $movie)
    {
        // 1. 若有海報檔案，一併自硬碟刪除
        if ($movie->poster_path && Storage::disk('public')->exists($movie->poster_path)) {
            Storage::disk('public')->delete($movie->poster_path);
        }

        // 2. 刪除資料庫紀錄
        $movie->delete();

        return redirect()->route('movies.index')
            ->with('success', '電影已成功刪除！');
    }
}