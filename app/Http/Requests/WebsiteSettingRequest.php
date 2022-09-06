<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebsiteSettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'key' => ['required', 'string', 'max:255', Rule::unique('website_settings', 'key')],
            'value' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string', 'max:255'],
        ];
    }
}