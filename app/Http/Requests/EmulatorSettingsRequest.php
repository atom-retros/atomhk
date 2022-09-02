<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmulatorSettingsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'setting' => ['required', 'string', 'max:100', Rule::unique('emulator_settings', 'key')->ignore($this->input('setting'), 'key')],
            'value' => ['required', 'string', 'max:300'],
        ];
    }
}