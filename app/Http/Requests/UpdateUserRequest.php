<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', Rule::unique('users')->ignore($this->route('user'))],
            'mail' => ['required', 'email', Rule::unique('users')->ignore($this->route('user'))],
            'motto' => ['nullable', 'string', 'max:50'],
            'rank' => ['required', 'integer', Rule::exists('permissions', 'id')],
            'credits' => ['required', 'integer', 'min:0'],
            'duckets' => ['required', 'integer', 'min:0'],
            'diamonds' => ['required', 'integer', 'min:0'],
            'points' => ['required', 'integer', 'min:0'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}