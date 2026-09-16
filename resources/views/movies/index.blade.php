@extends('layouts.app')

@section('create_movies')
    <a href="{{ route('movies.create') }}"
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
        + 新增電影
    </a>
@endsection

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">電影清單</h1>
    </div>

    <!-- 搜尋與篩選表單區塊 -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
        <form action="{{ route('movies.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3">
            <!-- 關鍵字搜尋 -->
            <div class="md:col-span-6">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="搜尋片名或導演..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- 類型下拉選單 -->
            <div class="md:col-span-3">
                <select name="genre"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <option value="">所有類型</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre }}" {{ request('genre') === $genre ? 'selected' : '' }}>
                            {{ $genre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 送出與清除按鈕 -->
            <div class="md:col-span-3 flex gap-2">
                <button type="submit"
                    class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition">
                    搜尋
                </button>
                @if (request()->hasAny(['search', 'genre']))
                    <a href="{{ route('movies.index') }}"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium rounded-lg transition flex items-center justify-center">
                        清除
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- 電影清單卡片區 -->
    @if ($movies->isEmpty())
        <div class="bg-white p-8 rounded-xl shadow-sm text-center text-gray-500">
            目前還沒有任何電影資料，點擊右上角「+ 新增電影」開始建立！
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($movies as $movie)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden flex flex-col border border-gray-100">
                    <!-- 海報展示區 -->
                    <div class="h-48 bg-gray-200 overflow-hidden flex items-center justify-center">
                        @if ($movie->poster_path)
                            <img src="{{ asset('storage/' . $movie->poster_path) }}" alt="{{ $movie->title }}"
                                class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-400 text-sm">無海報圖片</span>
                        @endif
                    </div>

                    <!-- 內容區 -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span
                                    class="text-xs font-semibold px-2.5 py-0.5 rounded bg-indigo-50 text-indigo-600">{{ $movie->genre }}</span>
                                <span class="text-xs font-semibold px-2 py-0.5 rounded bg-amber-50 text-amber-600">⭐
                                    {{ number_format($movie->rating, 1) }}</span>
                            </div>
                            <h2 class="text-lg font-bold text-gray-900 mb-1">{{ $movie->title }}</h2>
                            <p class="text-xs text-gray-500 mb-3">年份：{{ $movie->release_year }} ｜
                                導演：{{ $movie->director ?? '未提供' }}</p>
                            <p class="text-sm text-gray-600 line-clamp-3 mb-4">{{ $movie->description ?? '暫無簡介。' }}</p>
                        </div>

                        <!-- 操作按鈕 -->
                        <div class="pt-4 border-t border-gray-100 flex items-center justify-end space-x-3 text-sm">
                            <a href="{{ route('movies.edit', $movie) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">編輯</a>
                            {{-- onsubmit 是在表單送出前觸發的事件 --}}
                            <form action="{{ route('movies.destroy', $movie) }}" method="POST"
                                onsubmit="return confirm('確定要刪除這部電影嗎？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">刪除</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 分頁導航 -->
        <div class="mt-8">
            {{ $movies->links() }}
        </div>
    @endif
@endsection
