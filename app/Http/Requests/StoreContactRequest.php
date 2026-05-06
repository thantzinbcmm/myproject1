// app/Http/Requests/StoreContactRequest.php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Contact;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'type'  => ['required', 'string', 'max:100', Rule::in(Contact::TYPES)],
            'value' => ['required', 'string', 'max:255'],
        ];

        if ($this->input('type') === 'email') {
            $rules['value'][] = 'email';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'type.required'  => '連絡先種別は必須です。',
            'type.in'        => '有効な連絡先種別を選択してください。',
            'value.required' => '連絡先情報は必須です。',
            'value.email'    => '有効なメールアドレス形式で入力してください。',
        ];
    }
}