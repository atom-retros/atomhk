<?php

namespace App\Services;

use App\Models\HousekeepingSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class HousekeepingSettingsService
{
    public ?Collection $settings;

    public function __construct()
    {
        $this->settings = Schema::hasTable('housekeeping_settings') ? HousekeepingSetting::all()->pluck('value', 'key') : collect();
    }

    public function getOrDefault(string $settingName, ?string $default = null): string
    {
        return (string) $this->settings->get($settingName, $default);
    }
}
