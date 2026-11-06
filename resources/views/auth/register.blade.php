<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- 姓名 -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">姓名 / 使用者名稱</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @else border-gray-300 @enderror">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 信箱 -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">電子郵件信箱</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @else border-gray-300 @enderror">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 密碼 -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">設定密碼</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @else border-gray-300 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 確認密碼 -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">再次確認密碼</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg text-sm transition">
            建立新帳號
        </button>

        <div class="text-center pt-2">
            <span class="text-xs text-gray-500">已經有帳號？</span>
            <a href="{{ route('login') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">返回登入</a>
        </div>
    </form>
</x-guest-layout>