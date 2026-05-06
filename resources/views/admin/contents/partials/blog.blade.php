// resources/views/admin/contents/partials/blog.blade.php
{{-- resources/views/admin/contents/partials/blog.blade.php --}}
<div x-data="{ showForm: false, editId: null }">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">ブログ一覧</h2>
        <button @click="showForm = !showForm; editId = null"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium
                       px-4 py-2 rounded-lg transition shadow-sm">
            ＋ 新規追加
        </button>
    </div>

    {{-- 新規追加フォーム --}}
    <div x-show="showForm && editId === null" x-transition
         class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-base font-semibold text-gray-700 mb-4">ブログ概要を追加</h3>
        <form method="POST" action="{{ route('admin.blog-summary.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        タイトル <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title"
                           value="{{ old('title') }}"
                           placeholder="ブログ記事のタイトル"
                           class="w-full border @error('title') border-red-400 @else border-gray-300 @enderror
                                  rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">外部URL</label>
                    <input type="url" name="url"
                           value="{{ old('url') }}"
                           placeholder="https://example.com/blog/..."
                           class="w-full border @error('url') border-red-400 @else border-gray-300 @enderror
                                  rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    @error('url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">概要</label>
                    <textarea name="summary" rows="3"
                              placeholder="ブログ記事の概要を入力してください"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                     focus:ring-2 focus:ring-indigo-400 focus:outline-none resize-none">{{ old('summary') }}</textarea>
                </div>
            </div>
            <div class="flex space-x-3 mt-4">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium
                               px-5 py-2 rounded-lg transition">
                    登録する
                </button>
                <button type="button" @click="showForm = false"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium
                               px-5 py-2 rounded-lg transition">
                    キャンセル
                </button>
            </div>
        </form>
    </div>

    {{-- ブログ一覧 --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @if($blogs->isEmpty())
            <div class="text-center py-12 text-gray-400">
                <p class="text-sm">ブログ概要が登録されていません。</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600 w-1/3">タイトル</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">概要</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600 w-1/4">URL</th>
                        <th class="px-5 py-3 w-24"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($blogs as $blog)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-4 font-medium text-gray-800">{{ e($blog->title) }}</td>
                        <td class="px-5 py-4 text-gray-500 truncate max-w-xs">
                            {{ e(Str::limit($blog->summary, 50)) }}
                        </td>
                        <td class="px-5 py-4">
                            @if($blog->url)
                                <a href="{{ e($blog->url) }}" target="_blank" rel="noopener noreferrer"
                                   class="text-indigo-500 hover:text-indigo-700 text-xs truncate block max-w-xs">
                                    {{ e(Str::limit($blog->url, 40)) }}
                                </a>
                            @else
                                <span class="text-gray-400 text-xs">未設定</span>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex space-x-2 justify-end">
                                <button @click="editId = {{ $blog->id }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium text-xs
                                               px-3 py-1 bg-indigo-50 hover:bg-indigo-100 rounded-md transition">
                                    編集
                                </button>
                                <form method="POST"
                                      action="{{ route('admin.blog-summary.destroy', $blog->id) }}"
                                      onsubmit="return confirm('このブログ概要を削除しますか？')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 font-medium text-xs
                                                   px-3 py-1 bg-red-50 hover:bg-red-100 rounded-md transition">
                                        削除
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- インライン編集 --}}
                    <tr x-show="editId === {{ $blog->id }}" x-transition>
                        <td colspan="4" class="px-5 py-4 bg-indigo-50">
                            <form method="POST"
                                  action="{{ route('admin.blog-summary.update', $blog->id) }}">
                                @csrf @method('PUT')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">
                                            タイトル <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="title"
                                               value="{{ e($blog->title) }}"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                                      focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                                               required>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">URL</label>
                                        <input type="url" name="url"
                                               value="{{ e($blog->url) }}"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                                      focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-medium text-gray-600 mb-1">概要</label>
                                        <textarea name="summary" rows="2"
                                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                                         focus:ring-2 focus:ring-indigo-400 focus:outline-none resize-none">{{ e($blog->summary) }}</textarea>
                                    </div>
                                </div>
                                <div class="flex space-x-3 mt-4">
                                    <button type="submit"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm
                                                   font-medium px-5 py-2 rounded-lg transition">
                                        更新する
                                    </button>
                                    <button type="button" @click="editId = null"
                                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm
                                                   font-medium px-5 py-2 rounded-lg transition">
                                        キャンセル
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>