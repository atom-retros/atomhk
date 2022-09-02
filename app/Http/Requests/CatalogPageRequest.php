<?php

namespace App\Http\Requests;

use App\Rules\CatalogPageLayoutRule;
use App\Rules\ParentIdRule;
use Illuminate\Foundation\Http\FormRequest;

class CatalogPageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => ['required', 'numeric', new ParentIdRule()],
            'caption' => ['required', 'string', 'max:128'],
            'visible' => ['required', 'in:0,1'],
            'enabled' => ['required', 'in:0,1'],
            'page_layout' => ['required', 'string', new CatalogPageLayoutRule()],
            'icon_image' => ['required', 'numeric'],
            'min_rank' => ['required', 'numeric'],
            'order_num' => ['required', 'numeric'],
            'page_headline' => ['nullable', 'string', 'max:1024'],
            'page_teaser' => ['nullable', 'string', 'max:64'],
            'page_text1' => ['nullable', 'string', 'max:2048'],
            'page_text2' => ['nullable', 'string'],
            'page_text_details' => ['nullable', 'string'],
        ];
    }
}