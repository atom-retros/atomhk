<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteBlacklistRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ip_address' => ['required', 'string'],
            'asn' => ['nullable', 'string'],
            'blacklist_asn' => ['required', 'string'],
        ];
    }
}