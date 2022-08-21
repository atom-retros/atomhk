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
                'comment' => 'Specifies path where all the article images are located'
            ],
            [
                'key' => 'avatar_imager',
                'value' => 'https://www.habbo.com/habbo-imaging/avatarimage?figure=',
                'comment' => 'The base url for the imager used to render avatars on the CMS',
            ],
            [
                'key' => 'tinymce_api_key',
                'value' => '',
                'comment' => 'The API key needed for the tiny mce editor',
            ],
        ];

        HousekeepingSetting::query()->upsert($settings, ['key']);
    }
}
