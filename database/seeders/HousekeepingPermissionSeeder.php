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
        ];

        HousekeepingPermission::query()->upsert($permissions, ['permission']);
    }
}
