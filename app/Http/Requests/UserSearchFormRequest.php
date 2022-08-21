<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSearchFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}