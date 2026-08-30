<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>電影管理系統</title>
    <!-- 引入 Tailwind CSS CDN 便於快速預覽 -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased min-h-screen">
    <!-- 導覽列 -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('movies.index') }}" class="text-xl font-bold text-indigo-600">🎬 電影管理系統</a>
            <a href="{{ route('movies.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                + 新增電影
            </a>
        </div>
    </nav>

    <!-- 訊息提示 -->
    <main class="max-w-6xl mx-auto px-4 py-8">
        {{-- 如果有session，就會顯示儲存在session的文字內容 --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>