<?php

namespace App\Services;

use App\Models\HousekeepingSetting;
use Illuminate\Support\Collection;

class HousekeepingSettingsService
{
    public ?Collection $settings;

    public function __construct()
    {
        $this->settings = HousekeepingSetting::all()->pluck('value', 'key');
    }

    public function getOrDefault(string $settingName, ?string $default = null): string
    {
        return (string)$this->settings->get($settingName, $default);
    }
}