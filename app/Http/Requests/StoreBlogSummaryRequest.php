// app/Http/Requests/StoreBlogSummaryRequest.php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogSummaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'   => ['required', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'url'     => ['nullable', 'url', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'ブログタイトルは必須です。',
            'title.max'      => 'タイトルは255文字以内で入力してください。',
            'url.url'        => '有効なURL形式で入力してください。',
        ];
    }
}