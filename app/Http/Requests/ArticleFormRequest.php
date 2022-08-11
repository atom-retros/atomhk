<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'short_story' => ['required', 'string', 'min:3', 'max:255'],
            'full_story' => ['required', 'string', 'min:3'],
            'image' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}