<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', '電影管理系統') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <!-- 標題文字取代 Laravel Logo -->
        <div class="text-center mb-8">
            <a href="{{ route('movies.index') }}" class="text-3xl font-extrabold text-indigo-600 tracking-tight">
                🎬 電影管理系統
            </a>
        </div>

        <!-- 認證卡片本體 -->
        <div class="bg-white py-8 px-6 shadow-sm border border-gray-100 rounded-xl sm:px-10">
            {{ $slot }}
        </div>
    </div>
</body>
</html>