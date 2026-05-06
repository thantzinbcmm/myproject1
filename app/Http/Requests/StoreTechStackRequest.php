// app/Http/Requests/StoreTechStackRequest.php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTechStackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stacks'   => ['required', 'array', 'min:1'],
            'stacks.*' => ['integer', 'exists:tech_stack_selection,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'stacks.required' => '1つ以上の技術スタックを選択してください。',
            'stacks.min'      => '1つ以上の技術スタックを選択してください。',
            'stacks.*.exists' => '選択された技術スタックが見つかりません。',
        ];
    }
}