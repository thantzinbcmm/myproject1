// resources/views/admin/contents/partials/contact.blade.php
{{-- resources/views/admin/contents/partials/contact.blade.php --}}
<div x-data="{ showForm: false, editId: null, selectedType: '{{ old('type', 'email') }}' }">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">連絡先一覧</h2>
        <button @click="showForm = !showForm; editId = null"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium
                       px-4 py-2 rounded-lg transition shadow-sm">
            ＋ 新規追加
        </button>
    </div>

    {{-- 新規追加フォーム --}}
    <div x-show="showForm && editId === null" x-transition
         class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-base font-semibold text-gray-700 mb-4">連絡先を追加</h3>
        <form method="POST" action="{{ route('admin.contact.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        種別 <span class="text-red-500">*</span>
                    </label>
                    <select name="type" x-model="selectedType"
                            class="w-full border @error('type') border-red-400 @else border-gray-300 @enderror
                                   rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        @foreach(\App\Models\Contact::TYPES as $type)
                            <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        連絡先情報 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="value"
                           value="{{ old('value') }}"
                           :placeholder="selectedType === 'email' ? 'example@thant.com'
                                       : selectedType === 'phone' ? '090-0000-0000'
                                       : 'https://...'"
                           class="w-full border @error('value') border-red-400 @else border-gray-300 @enderror
                                  rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    @error('value')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
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

    {{-- 連絡先一覧 --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @if($contacts->isEmpty())
            <div class="text-center py-12 text-gray-400">
                <p class="text-sm">連絡先が登録されていません。</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600 w-1/4">種別</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">連絡先情報</th>
                        <th class="px-5 py-3 w-24"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($contacts as $contact)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                         bg-indigo-100 text-indigo-800">
                                {{ ucfirst(e($contact->type)) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-gray-700">{{ e($contact->value) }}</td>
                        <td class="px-5 py-4">
                            <div class="flex space-x-2 justify-end">
                                <button @click="editId = {{ $contact->id }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium text-xs
                                               px-3 py-1 bg-indigo-50 hover:bg-indigo-100 rounded-md transition">
                                    編集
                                </button>
                                <form method="POST"
                                      action="{{ route('admin.contact.destroy', $contact->id) }}"
                                      onsubmit="return confirm('この連絡先を削除しますか？')">
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
                    <tr x-show="editId === {{ $contact->id }}" x-transition>
                        <td colspan="3" class="px-5 py-4 bg-indigo-50">
                            <form method="POST"
                                  action="{{ route('admin.contact.update', $contact->id) }}">
                                @csrf @method('PUT')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">
                                            種別 <span class="text-red-500">*</span>
                                        </label>
                                        <select name="type"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                                       focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                                            @foreach(\App\Models\Contact::TYPES as $type)
                                                <option value="{{ $type }}"
                                                    {{ $contact->type === $type ? 'selected' : '' }}>
                                                    {{ ucfirst($type) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">
                                            連絡先情報 <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="value"
                                               value="{{ e($contact->value) }}"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                                      focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                                               required>
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