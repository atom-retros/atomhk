<?php

use App\Models\HousekeepingSetting;

function setting(string $setting): string
{
    return HousekeepingSetting::query()->where('key', '=', $setting)->first()->value ?? '';
}