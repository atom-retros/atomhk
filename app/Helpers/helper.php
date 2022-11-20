<?php

use App\Models\HousekeepingPermission;
use App\Models\HousekeepingSetting;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}

function sensitiveInfo($string)
{
    $len = strlen($string);

    return substr($string, 0, 3) . str_repeat('*', 6) . substr($string, $len - 4, 6);
}

// TODO: Rewrite into service
function setting(string $setting): string
{
    return HousekeepingSetting::query()->where('key', '=', $setting)->first()->value ?? '';
}

// TODO: Rewrite into service
function cmsSetting(string $setting): string
{
    return WebsiteSetting::query()->where('key', '=', $setting)->first()->value ?? '';
}

// TODO: Rewrite into service
function hasPermission($user, string $permission): bool
{
    return $user->rank >= HousekeepingPermission::query()
            ->where('permission', '=', $permission)
            ->first()->min_rank;
}