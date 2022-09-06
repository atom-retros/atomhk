<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebsiteSettingUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'key' => ['required', 'string', 'max:255', Rule::unique('website_settings', 'key')->ignore($this->input('key'), 'key')],
            'value' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string', 'max:255'],
        ];
    }
}