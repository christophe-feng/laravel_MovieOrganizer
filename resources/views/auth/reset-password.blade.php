<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-800">重設您的密碼</h2>
        <p class="text-xs text-gray-500 mt-1">請為您的帳號設定一組新的安全密碼</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- 密碼重設 Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- 電子郵件信箱 -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">電子郵件信箱</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                   class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @else border-gray-300 @enderror">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 新密碼 -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">設定新密碼</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @else border-gray-300 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 確認新密碼 -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">再次確認新密碼</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg text-sm transition shadow-sm">
            確認並重設密碼
        </button>

        <div class="text-center pt-2">
            <a href="{{ route('login') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">返回登入頁</a>
        </div>
    </form>
</x-guest-layout>