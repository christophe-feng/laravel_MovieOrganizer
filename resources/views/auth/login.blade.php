<x-guest-layout>
    <!-- Session 狀態訊息 -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- 電子郵件 -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">電子郵件信箱</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @else border-gray-300 @enderror">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 密碼 -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">密碼</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @else border-gray-300 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 記住我與忘記密碼 -->
        <div class="flex items-center justify-between text-sm">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-gray-600 text-xs">記住我的登入狀態</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-indigo-600 hover:text-indigo-800" href="{{ route('password.request') }}">
                    忘記密碼？
                </a>
            @endif
        </div>

        <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg text-sm transition">
            登入帳號
        </button>

        <div class="text-center pt-2">
            <span class="text-xs text-gray-500">還沒有帳號嗎？</span>
            <a href="{{ route('register') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">點此立即註冊</a>
        </div>
    </form>
</x-guest-layout>