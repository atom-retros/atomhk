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
            [
                'key' => 'article_images_path',
                'value' => '/assets/images/articles',
                'comment' => 'Specifies path where all t he article images are located'
            ],
        ];

        HousekeepingSetting::query()->upsert($settings, ['key']);
    }
}
