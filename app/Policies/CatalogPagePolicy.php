<?php

namespace App\Policies;

use App\Models\CatalogPage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogPagePolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return hasPermission('manage_catalog_pages');
    }

    public function view()
    {
        return hasPermission('manage_catalog_pages');
    }

    public function create()
    {
        return hasPermission('manage_catalog_pages');
    }

    public function update()
    {
        return hasPermission('manage_catalog_pages');
    }

    public function delete()
    {
        return hasPermission('delete_catalog_pages');
    }
}
