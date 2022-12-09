<?php

namespace App\Policies;

use App\Models\CatalogPage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogPagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return hasPermission('manage_catalog_pages');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CatalogPage  $catalogPage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CatalogPage $catalogPage)
    {
        return hasPermission('manage_catalog_pages');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return hasPermission('manage_catalog_pages');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CatalogPage  $catalogPage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CatalogPage $catalogPage)
    {
        return hasPermission('manage_catalog_pages');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CatalogPage  $catalogPage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CatalogPage $catalogPage)
    {
        return hasPermission('delete_catalog_pages');
    }
}
