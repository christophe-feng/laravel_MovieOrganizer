@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- 左側：新增分類 -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 h-fit">
        <h2 class="text-lg font-bold text-gray-800 mb-4">➕ 新增電影分類</h2>
        <form action="{{ route('genres.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">分類名稱</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="例：動作、科幻、懸疑"
                       class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @else border-gray-300 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg text-sm transition">
                儲存分類
            </button>
        </form>
    </div>

    <!-- 右側：分類列表與行內修改 -->
    <div class="md:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-4">🏷️ 現有分類清單 ({{ $genres->count() }})</h2>

        @if ($genres->isEmpty())
            <p class="text-gray-500 text-sm text-center py-6">目前尚未建立任何分類。</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-500">
                            <th class="py-3 px-2 font-medium">分類名稱</th>
                            <th class="py-3 px-2 font-medium text-center">關聯電影數</th>
                            <th class="py-3 px-2 font-medium text-right">操作</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($genres as $genre)
                            <tr class="hover:bg-gray-50/50">
                                <!-- 行內修改表單 -->
                                <td class="py-3 px-2">
                                    <form id="update-form-{{ $genre->id }}" action="{{ route('genres.update', $genre) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $genre->name }}" 
                                               class="px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </form>
                                </td>

                                <!-- 關聯電影數統計 -->
                                <td class="py-3 px-2 text-center text-gray-600 font-medium">
                                    <span class="inline-block bg-gray-100 px-2.5 py-0.5 rounded-full text-xs">
                                        {{ $genre->movies_count }} 部
                                    </span>
                                </td>

                                <!-- 操作按鈕 -->
                                <td class="py-3 px-2 text-right space-x-2">
                                    <button type="submit" form="update-form-{{ $genre->id }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs">
                                        儲存
                                    </button>
                                    <form action="{{ route('genres.destroy', $genre) }}" method="POST" class="inline" onsubmit="return confirm('確定要刪除分類「{{ $genre->name }}」嗎？（關聯電影不會被刪除，將變為未分類）');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-xs">
                                            刪除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection