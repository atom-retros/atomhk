<?php

namespace App\Rules;

use App\Enums\CatalogPageLayoutEnum;
use Illuminate\Contracts\Validation\InvokableRule;

class CatalogPageLayoutRule implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        $layouts = [];

        foreach (CatalogPageLayoutEnum::cases() as $layout) {
            $layouts[] = $layout->value;
        }

        if (!in_array($value, $layouts)) {
            $fail('The catalog page layout does not exist');
        }
    }
}