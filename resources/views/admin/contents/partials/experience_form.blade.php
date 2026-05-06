// resources/views/admin/contents/partials/experience_form.blade.php
{{-- resources/views/admin/contents/partials/experience_form.blade.php --}}
<input type="hidden" name="_form" value="experience">
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            タイトル（役職など）<span class="text-red-500">*</span>
        </label>
        <input type="text" name="title"
               value="{{ old('title') }}"
               placeholder="例：シニアソフトウェアエンジニア"
               class="w-full border @error('title') border-red-400 @else border-gray-300 @enderror
                      rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">詳細説明</label>
        <input type="text" name="description"
               value="{{ old('description') }}"
               placeholder="例：5年間のWebアプリ開発"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                      focus:ring-2 focus:ring-indigo-400 focus:outline-none">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">開始日</label>
        <input type="date" name="period_from"
               value="{{ old('period_from') }}"
               class="w-full border @error('period_from') border-red-400 @else border-gray-300 @enderror
                      rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        @error('period_from')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">終了日（空欄で現職）</label>
        <input type="date" name="period_to"
               value="{{ old('period_to') }}"
               class="w-full border @error('period_to') border-red-400 @else border-gray-300 @enderror
                      rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        @error('period_to')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>