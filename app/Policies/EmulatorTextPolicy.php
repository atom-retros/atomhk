<?php

namespace App\Policies;

use App\Models\EmulatorSetting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmulatorTextPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return hasPermission($user, 'manage_emulator_texts');
    }

    public function create(User $user)
    {
        return hasPermission($user, 'manage_emulator_texts');
    }

    public function update(User $user)
    {
        return hasPermission($user, 'manage_emulator_texts');
    }


    public function delete(User $user)
    {
        return hasPermission($user, 'manage_emulator_texts');
    }
}
