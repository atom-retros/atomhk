<?php

namespace App\Rules;

use App\Models\CatalogPage;
use Illuminate\Contracts\Validation\InvokableRule;

class ParentIdRule implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        $page = CatalogPage::query()->where('id', '=', $value)->first();
        if ($value != -1 && is_null($page)) {
            $fail('The parent id does not exist');
        }
    }
}