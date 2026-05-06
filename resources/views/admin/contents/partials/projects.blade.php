// resources/views/admin/contents/partials/projects.blade.php
{{-- resources/views/admin/contents/partials/projects.blade.php --}}
<div x-data="{ showForm: false, editId: null }">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">プロジェクト一覧</h2>
        <button @click="showForm = !showForm; editId = null"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium
                       px-4 py-2 rounded-lg transition shadow-sm">
            ＋ 新規追加
        </button>
    </div>

    {{-- 新規追加フォーム --}}
    <div x-show="showForm && editId === null" x-transition
         class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-base font-semibold text-gray-700 mb-4">プロジェクトを追加</h3>
        <form method="POST" action="{{ route('admin.projects.store') }}">
            @csrf
            <input type="hidden" name="_form" value="project">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        プロジェクト名 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name"
                           value="{{ old('name') }}"
                           placeholder="例：ECサイトリニューアル"
                           class="w-full border @error('name') border-red-400 @else border-gray-300 @enderror
                                  rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">使用技術</label>
                    <input type="text" name="tech_stack"
                           value="{{ old('tech_stack') }}"
                           placeholder="例：Laravel, Vue.js, MySQL"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                  focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">プロジェクト説明</label>
                    <textarea name="description" rows="3"
                              placeholder="プロジェクトの概要・担当内容を記述してください"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                     focus:ring-2 focus:ring-indigo-400 focus:outline-none resize-none">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">開始日</label>
                    <input type="date" name="period_from"
                           value="{{ old('period_from') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                  focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">終了日</label>
                    <input type="date" name="period_to"
                           value="{{ old('period_to') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                  focus:ring-2 focus:ring-indigo-400 focus:outline-none">
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

    {{-- プロジェクト一覧 --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @if($projects->isEmpty())
            <div class="text-center py-12 text-gray-400">
                <p class="text-sm">プロジェクトが登録されていません。</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">プロジェクト名</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">技術</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">期間</th>
                        <th class="px-5 py-3 w-24"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($projects as $project)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-4 font-medium text-gray-800">{{ e($project->name) }}</td>
                        <td class="px-5 py-4 text-gray-500 text-xs">{{ e($project->tech_stack) }}</td>
                        <td class="px-5 py-4 text-gray-500">
                            {{ $project->period_from?->format('Y/m') ?? '–' }}
                            〜
                            {{ $project->period_to?->format('Y/m') ?? '現在' }}
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex space-x-2 justify-end">
                                <button @click="editId = {{ $project->id }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium text-xs
                                               px-3 py-1 bg-indigo-50 hover:bg-indigo-100 rounded-md transition">
                                    編集
                                </button>
                                <form method="POST"
                                      action="{{ route('admin.projects.destroy', $project->id) }}"
                                      onsubmit="return confirm('このプロジェクトを削除しますか？')">
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
                    <tr x-show="editId === {{ $project->id }}" x-transition>
                        <td colspan="4" class="px-5 py-4 bg-indigo-50">
                            <form method="POST"
                                  action="{{ route('admin.projects.update', $project->id) }}">
                                @csrf @method('PUT')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">
                                            プロジェクト名 <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="name"
                                               value="{{ e($project->name) }}"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                                      focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                                               required>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">使用技術</label>
                                        <input type="text" name="tech_stack"
                                               value="{{ e($project->tech_stack) }}"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                                      focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-medium text-gray-600 mb-1">説明</label>
                                        <textarea name="description" rows="2"
                                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                                         focus:ring-2 focus:ring-indigo-400 focus:outline-none resize-none">{{ e($project->description) }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">開始日</label>
                                        <input type="date" name="period_from"
                                               value="{{ $project->period_from?->format('Y-m-d') }}"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                                      focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">終了日</label>
                                        <input type="date" name="period_to"
                                               value="{{ $project->period_to?->format('Y-m-d') }}"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                                      focus:ring-2 focus:ring-indigo-400 focus:outline-none">
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