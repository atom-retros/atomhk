<?php

use App\Models\HousekeepingPermission;
use App\Models\HousekeepingSetting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

function setting(string $setting): string
{
    return HousekeepingSetting::query()->where('key', '=', $setting)->first()->value ?? '';
}

function hasPermission($user, string $permission): bool
{
    return $user->rank ?? 0 >= HousekeepingPermission::query()
            ->where('permission', '=', $permission)
            ->first()->min_rank;
}