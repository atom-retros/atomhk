<?php

namespace Database\Seeders;

use App\Models\HousekeepingPermission;
use Illuminate\Database\Seeder;

class HousekeepingPermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'permission' => 'can_login',
                'min_rank' => 6,
                'description' => 'The minimum rank required before being able to login to the housekeeping',
            ],
            [
                'permission' => 'edit_user',
                'min_rank' => 6,
                'description' => 'The minimum rank required before being able to edit a user',
            ],
            [
                'permission' => 'delete_user',
                'min_rank' => 7,
                'description' => 'The minimum rank required before being able to delete a user',
            ],
            [
                'permission' => 'write_article',
                'min_rank' => 6,
                'description' => 'The minimum rank required before being able to write an article',
            ],
            [
                'permission' => 'edit_article',
                'min_rank' => 6,
                'description' => 'The minimum rank required before being able to edit an article',
            ],
            [
                'permission' => 'delete_article',
                'min_rank' => 6,
                'description' => 'The minimum rank required before being able to delete an article',
            ],
            [
                'permission' => 'manage_wordfilter',
                'min_rank' => 6,
                'description' => 'The minimum rank required before being able to manage the wordfilter',
            ],
            [
                'permission' => 'manage_bans',
                'min_rank' => 6,
                'description' => 'The minimum rank required before being able to manage the bans',
            ],
        ];

        HousekeepingPermission::query()->upsert($permissions, ['permission']);
    }
}
