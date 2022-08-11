<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $model): bool
    {
        return hasPermission($user, 'edit_user');
    }

    public function delete(User $user, User $model): bool
    {
        return hasPermission($user, 'delete_user');
    }
}