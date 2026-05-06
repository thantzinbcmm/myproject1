// app/Http/Requests/StoreExperienceRequest.php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'period_from' => ['nullable', 'date'],
            'period_to'   => ['nullable', 'date', 'after_or_equal:period_from'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'             => 'タイトルは必須です。',
            'title.max'                  => 'タイトルは255文字以内で入力してください。',
            'period_from.date'           => '開始日は有効な日付形式で入力してください。',
            'period_to.date'             => '終了日は有効な日付形式で入力してください。',
            'period_to.after_or_equal'   => '終了日は開始日以降の日付を入力してください。',
        ];
    }
}