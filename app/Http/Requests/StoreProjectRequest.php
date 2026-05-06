// app/Http/Requests/StoreProjectRequest.php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'tech_stack'  => ['nullable', 'string', 'max:255'],
            'period_from' => ['nullable', 'date'],
            'period_to'   => ['nullable', 'date', 'after_or_equal:period_from'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'            => 'プロジェクト名は必須です。',
            'name.max'                 => 'プロジェクト名は255文字以内で入力してください。',
            'period_from.date'         => '開始日は有効な日付形式で入力してください。',
            'period_to.date'           => '終了日は有効な日付形式で入力してください。',
            'period_to.after_or_equal' => '終了日は開始日以降の日付を入力してください。',
        ];
    }
}