<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>電影管理系統</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased min-h-screen">
    <!-- 頂部導航 -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- 左側選單 -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('movies.index') }}" class="text-xl font-bold text-indigo-600">🎬 電影管理系統</a>
                <a href="{{ route('movies.index') }}" class="text-sm font-medium {{ request()->routeIs('movies.*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">電影清單</a>
                
                <!-- 僅登入者看得到分類管理 -->
                @auth
                    <a href="{{ route('genres.index') }}" class="text-sm font-medium {{ request()->routeIs('genres.*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">分類管理</a>
                @endauth
            </div>

            <!-- 右側操作與認證區 -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- 登入後顯示：會員名稱與會員登出 -->                    
                    <span class="text-sm text-gray-600 font-medium">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-red-600 transition">登出</button>
                    </form>
                @else
                    <!-- 訪客顯示：登入 / 註冊 -->
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-indigo-600 font-medium transition">登入</a>
                    <a href="{{ route('register') }}" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 px-3.5 py-1.5 rounded-lg text-sm font-medium transition">註冊</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- 提示訊息與主要內容 -->
    <main class="max-w-6xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>