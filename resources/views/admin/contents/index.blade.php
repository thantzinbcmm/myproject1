// resources/views/admin/contents/index.blade.php
{{-- resources/views/admin/contents/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div x-data="{ activeTab: '{{ request('tab', 'experience') }}' }">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">掲載コンテンツ管理</h1>
        <p class="text-gray-500 text-sm mt-1">経歴・プロジェクト・ブログ・連絡先を管理します。</p>
    </div>

    {{-- タブナビゲーション --}}
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-6">
            @foreach([
                ['key' => 'experience', 'label' => '📋 経歴'],
                ['key' => 'projects',   'label' => '🚀 プロジェクト'],
                ['key' => 'blog',       'label' => '📝 ブログ'],
                ['key' => 'contact',    'label' => '📬 連絡先'],
            ] as $tab)
            <button @click="activeTab = '{{ $tab['key'] }}'"
                    :class="activeTab === '{{ $tab['key'] }}'
                        ? 'border-indigo-600 text-indigo-600'
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap pb-3 px-1 border-b-2 font-medium text-sm transition-colors">
                {{ $tab['label'] }}
            </button>
            @endforeach
        </nav>
    </div>

    {{-- 経歴タブ --}}
    <div x-show="activeTab === 'experience'">
        @include('admin.contents.partials.experience', ['experiences' => $experiences])
    </div>

    {{-- プロジェクトタブ --}}
    <div x-show="activeTab === 'projects'">
        @include('admin.contents.partials.projects', ['projects' => $projects ?? collect()])
    </div>

    {{-- ブログタブ --}}
    <div x-show="activeTab === 'blog'">
        @include('admin.contents.partials.blog', ['blogs' => $blogs ?? collect()])
    </div>

    {{-- 連絡先タブ --}}
    <div x-show="activeTab === 'contact'">
        @include('admin.contents.partials.contact', ['contacts' => $contacts ?? collect()])
    </div>

</div>
@endsection