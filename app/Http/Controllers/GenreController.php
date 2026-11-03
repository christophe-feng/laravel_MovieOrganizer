<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * 分類列表頁（同時顯示新增表單）
     */
    public function index()
    {
        // 包含每種類型底下的電影數量統計 (withCount)
        $genres = Genre::withCount('movies')->latest()->get();

        return view('genres.index', compact('genres'));
    }

    /**
     * 儲存新增分類
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:genres,name',
        ], [
            'name.required' => '請輸入分類名稱',
            'name.unique'   => '該分類名稱已經存在',
            'name.max'      => '分類名稱不能超過 50 個字元',
        ]);

        Genre::create($validated);

        return redirect()->route('genres.index')->with('success', '分類「' . $validated['name'] . '」新增成功！');
    }

    /**
     * 更新分類名稱
     */
    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:genres,name,' . $genre->id,
        ], [
            'name.required' => '請輸入分類名稱',
            'name.unique'   => '該分類名稱已經存在',
        ]);

        $genre->update($validated);

        return redirect()->route('genres.index')->with('success', '分類更新完成！');
    }

    /**
     * 刪除分類
     */
    public function destroy(Genre $genre)
    {
        $name = $genre->name;
        
        // 刪除分類（先前 Migration 有設定 nullOnDelete()，關聯的電影分類會自動設為 NULL，不會被誤刪）
        $genre->delete();

        return redirect()->route('genres.index')->with('success', '分類「' . $name . '」已成功刪除！');
    }
}
