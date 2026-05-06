// resources/views/admin/contents/partials/experience.blade.php
{{-- resources/views/admin/contents/partials/experience.blade.php --}}
<div x-data="{ showForm: false, editId: null, editData: {} }">

    {{-- 新規追加ボタン --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">経歴一覧</h2>
        <button @click="showForm = !showForm; editId = null; editData = {}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium
                       px-4 py-2 rounded-lg transition shadow-sm">
            ＋ 新規追加
        </button>
    </div>

    {{-- 新規追加フォーム --}}
    <div x-show="showForm && editId === null" x-transition
         class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-base font-semibold text-gray-700 mb-4">経歴を追加</h3>
        <form method="POST" action="{{ route('admin.experience.store') }}">
            @csrf
            @include('admin.contents.partials.experience_form')
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

    {{-- バリデーションエラー --}}
    @if($errors->any() && old('_form') === 'experience')
        <div class="bg-red-50 border border-red-300 rounded-lg p-4 mb-4">
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 経歴一覧テーブル --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @if($experiences->isEmpty())
            <div class="text-center py-12 text-gray-400">
                <p class="text-sm">経歴情報が登録されていません。</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600 w-1/3">タイトル</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">期間</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">説明</th>
                        <th class="px-5 py-3 w-24"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($experiences as $exp)
                    <tr class="hover:bg-gray-50 transition" x-data="{}">
                        <td class="px-5 py-4 font-medium text-gray-800">{{ e($exp->title) }}</td>
                        <td class="px-5 py-4 text-gray-500">
                            {{ $exp->period_from?->format('Y/m') ?? '–' }}
                            〜
                            {{ $exp->period_to?->format('Y/m') ?? '現在' }}
                        </td>
                        <td class="px-5 py-4 text-gray-500 truncate max-w-xs">
                            {{ e(Str::limit($exp->description, 60)) }}
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex space-x-2 justify-end">
                                {{-- 編集ボタン --}}
                                <button @click="editId = {{ $exp->id }};
                                                editData = {
                                                    title: '{{ e($exp->title) }}',
                                                    description: '{{ addslashes($exp->description) }}',
                                                    period_from: '{{ $exp->period_from?->format('Y-m-d') }}',
                                                    period_to: '{{ $exp->period_to?->format('Y-m-d') }}'
                                                };
                                                showForm = true"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium text-xs
                                               px-3 py-1 bg-indigo-50 hover:bg-indigo-100 rounded-md transition">
                                    編集
                                </button>
                                {{-- 削除ボタン --}}
                                <form method="POST"
                                      action="{{ route('admin.experience.destroy', $exp->id) }}"
                                      onsubmit="return confirm('この経歴を削除してよろしいですか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 font-medium text-xs
                                                   px-3 py-1 bg-red-50 hover:bg-red-100 rounded-md transition">
                                        削除
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- インライン編集フォーム --}}
                    <tr x-show="editId === {{ $exp->id }}" x-transition>
                        <td colspan="4" class="px-5 py-4 bg-indigo-50">
                            <form method="POST"
                                  action="{{ route('admin.experience.update', $exp->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">
                                            タイトル <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="title"
                                               :value="editData.title"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2
                                                      text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                                               required>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">説明</label>
                                        <input type="text" name="description"
                                               :value="editData.description"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2
                                                      text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">開始日</label>
                                        <input type="date" name="period_from"
                                               :value="editData.period_from"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2
                                                      text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">
                                            終了日（空欄で現職）
                                        </label>
                                        <input type="date" name="period_to"
                                               :value="editData.period_to"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2
                                                      text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                                    </div>
                                </div>
                                <div class="flex space-x-3 mt-4">
                                    <button type="submit"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm
                                                   font-medium px-5 py-2 rounded-lg transition">
                                        更新する
                                    </button>
                                    <button type="button" @click="editId = null; showForm = false"
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