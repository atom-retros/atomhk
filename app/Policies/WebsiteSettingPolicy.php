<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsiteSettingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return hasPermission('manage_website_settings');
    }

    public function view(WebsiteSetting $websiteSetting)
    {
        return hasPermission('manage_website_settings');
    }

    public function create()
    {
        return hasPermission('manage_website_settings');
    }

    public function update(User $user)
    {
        return hasPermission('manage_website_settings');
    }

    public function delete(WebsiteSetting $websiteSetting)
    {
        return hasPermission('manage_website_settings');
    }
}
