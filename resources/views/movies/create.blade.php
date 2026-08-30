@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
    <div class="mb-6 pb-4 border-b border-gray-200 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">新增電影</h1>
        <a href="{{ route('movies.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← 返回列表</a>
    </div>

    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- 電影名稱 -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">電影名稱 <span class="text-red-500">*</span></label>
            {{-- @error 用於表單錯誤驗證 --}}
            <input type="text" name="title" value="{{ old('title') }}" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('title') border-red-500 @else border-gray-300 @enderror">
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 導演 & 上映年份 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">導演</label>
                <input type="text" name="director" value="{{ old('director') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">上映年份 <span class="text-red-500">*</span></label>
                <input type="number" name="release_year" value="{{ old('release_year', date('Y')) }}" min="1900" max="2100" 
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('release_year') border-red-500 @else border-gray-300 @enderror">
                @error('release_year')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- 類型 & 評分 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">類型</label>
                <input type="text" name="genre" value="{{ old('genre', '劇情') }}" placeholder="例：動作、科幻、喜劇"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">評分 (0.0 ~ 10.0)</label>
                <input type="number" step="0.1" name="rating" value="{{ old('rating', 8.0) }}" min="0" max="10" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <!-- 劇情簡介 -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">劇情簡介</label>
            <textarea name="description" rows="4" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
        </div>

        <!-- 海報上傳 -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">電影海報圖片</label>
            <input type="file" name="poster" accept="image/*" 
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            @error('poster')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 送出按鈕 -->
        <div class="pt-4 flex justify-end space-x-3">
            <a href="{{ route('movies.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 transition">取消</a>
            <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition">建立電影</button>
        </div>
    </form>
</div>
@endsection