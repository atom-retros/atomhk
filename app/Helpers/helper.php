<?php

use App\Models\HousekeepingPermission;
use App\Models\HousekeepingSetting;
use App\Models\User;
use App\Models\WebsiteSetting;
use App\Services\HousekeepingSettingsService;
use App\Services\PermissionsService;
use App\Services\WebsiteSettingsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}

if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
{
    $_SERVER["REMOTE_ADDR"] = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

function sensitiveInfo($string)
{
    $len = strlen($string);

    return substr($string, 0, 3) . str_repeat('*', 6) . substr($string, $len - 4, 6);
}

if (!function_exists('setting')) {
    function setting(string $setting): string
    {
        return app(HousekeepingSettingsService::class)->getOrDefault($setting);
    }
}

if (!function_exists('cmsSetting')) {
    function cmsSetting(string $setting): string
    {
        return app(WebsiteSettingsService::class)->getOrDefault($setting);
    }
}

if (!function_exists('hasPermission')) {
    function hasPermission(string $permission): string
    {
        return app(PermissionsService::class)->getOrDefault($permission);
    }
}

if (!function_exists('hasTable')) {
    function hasTable(string $table): bool
    {
        return Schema::hasTable($table);
    }
}
