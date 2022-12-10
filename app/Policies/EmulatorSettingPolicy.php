<?php

namespace App\Policies;

use App\Models\EmulatorSetting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmulatorSettingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return hasPermission('manage_emulator_settings');
    }

    public function create(User $user)
    {
        return hasPermission('manage_emulator_settings');
    }

    public function update(User $user)
    {
        return hasPermission('manage_emulator_settings');
    }


    public function delete(User $user)
    {
        return hasPermission('manage_emulator_settings');
    }
}
