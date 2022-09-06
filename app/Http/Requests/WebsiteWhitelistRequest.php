<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteWhitelistRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ip_address' => ['required', 'string'],
            'asn' => ['nullable', 'string'],
            'whitelist_asn' => ['required', 'string'],
        ];
    }
}