<?php

namespace App\Policies;

use App\Models\ChatlogPrivate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatlogPrivatePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return hasPermission('manage_room_chatlogs');
    }
}