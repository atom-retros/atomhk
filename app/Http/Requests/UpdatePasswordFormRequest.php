<?php

namespace App\Http\Requests;

use App\Actions\Fortify\Rules\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordFormRequest extends FormRequest
{
    use PasswordValidationRules;

    public function rules(): array
    {
        return [
            'password' => $this->passwordRules(),
        ];
    }
}