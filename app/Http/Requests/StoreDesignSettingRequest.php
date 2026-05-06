// app/Http/Requests/StoreDesignSettingRequest.php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\DesignSetting;

class StoreDesignSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'theme'        => ['required', 'string', Rule::in(DesignSetting::THEMES)],
            'color_scheme' => ['nullable', 'string', Rule::in(DesignSetting::COLOR_SCHEMES)],
            'font_style'   => ['nullable', 'string', Rule::in(DesignSetting::FONT_STYLES)],
        ];
    }

    public function messages(): array
    {
        return [
            'theme.required' => 'テーマは必須です。',
            'theme.in'       => '有効なテーマを選択してください。',
            'color_scheme.in' => '有効なカラースキームを選択してください。',
            'font_style.in'  => '有効なフォントスタイルを選択してください。',
        ];
    }
}