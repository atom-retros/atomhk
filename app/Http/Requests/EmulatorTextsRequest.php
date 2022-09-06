<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmulatorTextsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'max:100', Rule::unique('emulator_texts', 'key')->ignore($this->input('text'), 'key')],
            'value' => ['required', 'string', 'max:300'],
        ];
    }
}