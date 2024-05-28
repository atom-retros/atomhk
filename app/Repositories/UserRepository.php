<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function fetchAll(): LengthAwarePaginator
    {
        return User::query()
            ->select(['id', 'username', 'mail', 'motto', 'rank', 'look', 'online', 'ip_current', 'last_online'])
            ->orderByDesc('id')
            ->paginate(15);
    }
}
