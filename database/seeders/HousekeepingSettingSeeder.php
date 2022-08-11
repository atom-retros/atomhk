<?php

namespace Database\Seeders;

use App\Models\HousekeepingSetting;
use Illuminate\Database\Seeder;

class HousekeepingSettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'key' => 'hotel_name',
                'value' => 'Atom',
                'comment' => 'Specifies the hotel name'
            ],
        ];

        HousekeepingSetting::query()->upsert($settings, ['key']);
    }
}
