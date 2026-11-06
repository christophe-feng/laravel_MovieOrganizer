<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-800">安全確認</h2>
        <p class="text-xs text-gray-600 mt-2 leading-relaxed">
            這是系統的安全防護區域。在繼續操作之前，請先輸入您當前的密碼以確認身分。
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- 密碼 -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">目前密碼</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @else border-gray-300 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg text-sm transition shadow-sm">
            確認送出
        </button>

        <div class="text-center pt-2">
            <a href="{{ route('movies.index') }}" class="text-xs text-gray-500 hover:text-gray-700 font-medium">取消並返回首頁</a>
        </div>
    </form>
</x-guest-layout>