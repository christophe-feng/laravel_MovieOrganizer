<x-guest-layout>
    <div class="mb-4 text-xs text-gray-600 leading-relaxed">
        忘記您的密碼了嗎？沒關係。只要提供您註冊時填寫的電子郵件信箱，我們將會寄送一封重設密碼連結給您。
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">電子郵件信箱</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @else border-gray-300 @enderror">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg text-sm transition">
            發送重設密碼連結
        </button>

        <div class="text-center pt-2">
            <a href="{{ route('login') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">返回登入頁</a>
        </div>
    </form>
</x-guest-layout>