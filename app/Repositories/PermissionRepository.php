<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class PermissionRepository
{
    // Permission::query()->where('id', '!=', $user->rank)->get(),

    public function fetchAll(string $orderBy = 'asc', string $orderByColumn = 'id'): Collection
    {
        return Permission::query()
            ->orderBy($orderByColumn, $orderBy)
            ->get();
    }

    public function fetchAllExceptRank(int $rank, string $orderBy = 'asc', string $orderByColumn = 'id'): Collection
    {
        return Permission::query()
            ->where('id', '!=', $rank)
            ->orderBy($orderByColumn, $orderBy)
            ->get();
    }
}
