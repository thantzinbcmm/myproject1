// resources/views/admin/design/index.blade.php
{{-- resources/views/admin/design/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">デザイン設定</h1>
        <p class="text-gray-500 text-sm mt-1">ポートフォリオサイトのテーマ・配色・フォントを設定します。</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <form method="POST" action="{{ route('admin.design.update') }}">
            @csrf @method('PUT')

            {{-- テーマ --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    デザインテーマ <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-3 gap-3">
                    @foreach($themes as $theme)
                    <label class="cursor-pointer">
                        <input type="radio" name="theme" value="{{ $theme }}"
                               {{ $setting->theme === $theme ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="border-2 rounded-xl p-4 text-center transition
                                    peer-checked:border-indigo-500 peer-checked:bg-indigo-50
                                    border-gray-200 hover:border-gray-300">
                            <div class="text-2xl mb-1">
                                @if($theme === 'simple') 🎯
                                @elseif($theme === 'modern') ⚡
                                @else 🎨
                                @endif
                            </div>
                            <p class="text-sm font-medium text-gray-700 capitalize">
                                @if($theme === 'simple') シンプル
                                @elseif($theme === 'modern') モダン
                                @else カラフル
                                @endif
                            </p>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('theme')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- カラースキーム --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    カラースキーム
                </label>
                <div class="flex flex-wrap gap-3">
                    @php
                    $colorMap = [
                        'blue'   => ['bg' => 'bg-blue-500',   'label' => 'ブルー'],
                        'green'  => ['bg' => 'bg-green-500',  'label' => 'グリーン'],
                        'red'    => ['bg' => 'bg-red-500',    'label' => 'レッド'],
                        'purple' => ['bg' => 'bg-purple-500', 'label' => 'パープル'],
                        'orange' => ['bg' => 'bg-orange-500', 'label' => 'オレンジ'],
                        'gray'   => ['bg' => 'bg-gray-500',   'label' => 'グレー'],
                    ];
                    @endphp
                    @foreach($colorSchemes as $color)
                    <label class="cursor-pointer">
                        <input type="radio" name="color_scheme" value="{{ $color }}"
                               {{ $setting->color_scheme === $color ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="flex items-center space-x-2 px-4 py-2 border-2 rounded-full transition
                                    peer-checked:border-indigo-500 border-gray-200 hover:border-gray-300">
                            <span class="w-4 h-4 rounded-full {{ $colorMap[$color]['bg'] ?? 'bg-gray-400' }}"></span>
                            <span class="text-sm text-gray-700">{{ $colorMap[$color]['label'] ?? $color }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('color_scheme')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- フォントスタイル --}}
            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    フォントスタイル
                </label>
                <select name="font_style"
                        class="w-full border @error('font_style') border-red-400 @else border-gray-300 @enderror
                               rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    @foreach($fontStyles as $font)
                        <option value="{{ $font }}" {{ $setting->font_style === $font ? 'selected' : '' }}>
                            {{ $font }}
                        </option>
                    @endforeach
                </select>
                @error('font_style')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold
                           py-3 px-6 rounded-lg transition shadow-sm">
                デザイン設定を保存する
            </button>
        </form>
    </div>

    {{-- 現在の設定プレビュー --}}
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-sm font-semibold text-gray-700 mb-3">現在の設定</h2>
        <dl class="grid grid-cols-3 gap-4 text-sm">
            <div>
                <dt class="text-gray-500">テーマ</dt>
                <dd class="font-medium text-gray-800 capitalize">{{ $setting->theme }}</dd>
            </div>
            <div>
                <dt class="text-gray-500">カラー</dt>
                <dd class="font-medium text-gray-800 capitalize">{{ $setting->color_scheme ?? '未設定' }}</dd>
            </div>
            <div>
                <dt class="text-gray-500">フォント</dt>
                <dd class="font-medium text-gray-800">{{ $setting->font_style ?? '未設定' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection