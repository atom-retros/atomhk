<?php

use App\Models\HousekeepingPermission;
use App\Models\HousekeepingSetting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

function sensitiveInfo($string)
{
    $len = strlen($string);

    return substr($string, 0, 3) . str_repeat('*', 6) . substr($string, $len - 4, 6);
}

function setting(string $setting): string
{
    if (!Cache::has('housekeeping_setting')) {
        $housekeepingSetting = HousekeepingSetting::query()->where('key', '=', $setting)->first()->value ?? '';

        Cache::put('housekeeping_setting', $housekeepingSetting, now()->addMinutes(30));
    }

    return Cache::get('housekeeping_setting');
}

function hasPermission($user, string $permission): bool
{
    if (!Cache::has('has_permission')) {
        $hasPermission = $user->rank >= HousekeepingPermission::query()
            ->where('permission', '=', $permission)
            ->first()->min_rank;

        Cache::put('has_permission', $hasPermission, now()->addMinutes(30));
    }

    return Cache::get('has_permission');
}