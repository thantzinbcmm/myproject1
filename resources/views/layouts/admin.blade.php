// resources/views/layouts/admin.blade.php
{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thant Portfolio 管理画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">

    {{-- ナビゲーション --}}
    <nav class="bg-indigo-700 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-8">
                    <span class="text-white font-bold text-xl tracking-wide">Thant Admin</span>
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('admin.contents.index') }}"
                           class="text-indigo-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium
                                  {{ request()->routeIs('admin.contents.*') ? 'bg-indigo-800 text-white' : '' }}">
                            掲載コンテンツ
                        </a>
                        <a href="{{ route('admin.design.index') }}"
                           class="text-indigo-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium
                                  {{ request()->routeIs('admin.design.*') ? 'bg-indigo-800 text-white' : '' }}">
                            デザイン設定
                        </a>
                        <a href="{{ route('admin.techstack.index') }}"
                           class="text-indigo-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium
                                  {{ request()->routeIs('admin.techstack.*') ? 'bg-indigo-800 text-white' : '' }}">
                            技術スタック
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-indigo-200 text-sm">{{ Auth::user()->name ?? '' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="text-indigo-200 hover:text-white text-sm px-3 py-1 border border-indigo-400
                                       rounded hover:border-white transition">
                            ログアウト
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- メインコンテンツ --}}
    <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        {{-- フラッシュメッセージ --}}
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 class="mb-6 flex items-center justify-between bg-green-50 border border-green-300
                        text-green-800 rounded-lg px-5 py-3 shadow-sm">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414
                                 L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-green-500 hover:text-green-700 ml-4">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show: true }" x-show="show"
                 class="mb-6 flex items-center justify-between bg-red-50 border border-red-300
                        text-red-800 rounded-lg px-5 py-3 shadow-sm">
                <span class="text-sm font-medium">{{ session('error') }}</span>
                <button @click="show = false" class="text-red-500 hover:text-red-700 ml-4">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>