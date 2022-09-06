<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsiteSettingPolicy
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
        return hasPermission($user, 'manage_website_settings');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, WebsiteSetting $websiteSetting)
    {
        return hasPermission($user, 'manage_website_settings');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return hasPermission($user, 'manage_website_settings');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return hasPermission($user, 'manage_website_settings');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, WebsiteSetting $websiteSetting)
    {
        return hasPermission($user, 'manage_website_settings');
    }
}
