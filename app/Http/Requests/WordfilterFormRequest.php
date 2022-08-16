<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WordfilterFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'key' => ['required', 'string', Rule::unique('wordfilter')],
            'replacement' => ['nullable', 'string'],
            'hide' => ['nullable', 'boolean'],
            'report' => ['nullable', 'boolean'],
            'mute' => ['nullable', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}