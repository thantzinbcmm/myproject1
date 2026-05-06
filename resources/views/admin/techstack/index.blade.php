// resources/views/admin/techstack/index.blade.php
{{-- resources/views/admin/techstack/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-2xl" x-data="techStackForm()">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">技術スタック選択</h1>
        <p class="text-gray-500 text-sm mt-1">ポートフォリオに表示する技術スタックを選択してください。</p>
    </div>

    {{-- バリデーションエラー --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-300 rounded-lg p-4 mb-6">
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <form method="POST" action="{{ route('admin.techstack.update') }}"
              @submit="validate">
            @csrf

            <div class="mb-6">
                <p class="text-sm font-semibold text-gray-700 mb-4">
                    使用する技術を選択してください（1つ以上必須）
                </p>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($stacks as $stack)
                    <label class="cursor-pointer">
                        <input type="checkbox"
                               name="stacks[]"
                               value="{{ $stack->id }}"
                               {{ $stack->selected ? 'checked' : '' }}
                               x-model="selectedStacks"
                               class="sr-only peer">
                        <div class="flex items-center space-x-2 px-4 py-3 border-2 rounded-xl transition
                                    peer-checked:border-indigo-500 peer-checked:bg-indigo-50
                                    border-gray-200 hover:border-gray-300">
                            <span class="w-4 h-4 rounded border-2 flex-shrink-0 flex items-center justify-center
                                         peer-checked:border-indigo-500 border-gray-300 transition"
                                  :class="selectedStacks.includes({{ $stack->id }})
                                          ? 'bg-indigo-500 border-indigo-500' : 'bg-white border-gray-300'">
                                <svg x-show="selectedStacks.includes({{ $stack->id }})"
                                     class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4
                                             a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <span class="text-sm font-medium text-gray-700">{{ e($stack->stack_name) }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>

                {{-- クライアントサイドバリデーションエラー --}}
                <p x-show="validationError"
                   class="text-red-500 text-sm mt-3">
                    1つ以上の技術スタックを選択してください。
                </p>
            </div>

            {{-- 選択数表示 --}}
            <div class="mb-6 p-3 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600">
                    選択中: <span x-text="selectedStacks.length" class="font-bold text-indigo-600"></span> 件
                </p>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold
                           py-3 px-6 rounded-lg transition shadow-sm">
                技術スタックを保存する
            </button>
        </form>
    </div>
</div>

<script>
function techStackForm() {
    return {
        selectedStacks: @json($stacks->where('selected', true)->pluck('id')->values()),
        validationError: false,

        validate(event) {
            if (this.selectedStacks.length === 0) {
                event.preventDefault();
                this.validationError = true;
            } else {
                this.validationError = false;
            }
        }
    }
}
</script>
@endsection