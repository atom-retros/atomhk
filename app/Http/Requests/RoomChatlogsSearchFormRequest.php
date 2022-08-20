<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomChatlogsSearchFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sort_by' => ['required', 'string'],
            'search_input' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}