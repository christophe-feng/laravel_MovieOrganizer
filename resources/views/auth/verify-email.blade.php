<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-800">請驗證您的電子郵件</h2>
        <p class="text-xs text-gray-600 mt-2 leading-relaxed text-left">
            感謝您的註冊！在開始之前，我們已發送一封驗證信至您的信箱，請點擊信中的驗證連結以啟用帳號。<br><br>
            如果您沒有收到郵件，可以點擊下方按鈕重新發送。
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-xs">
            新的驗證連結已成功發送至您註冊時填寫的電子郵件信箱。
        </div>
    @endif

    <div class="space-y-3">
        <!-- 重新發送按鈕 -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg text-sm transition shadow-sm">
                重新發送驗證信
            </button>
        </form>

        <!-- 登出按鈕 -->
        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-xs text-gray-500 hover:text-red-600 font-medium transition">
                登出帳號
            </button>
        </form>
    </div>
</x-guest-layout>