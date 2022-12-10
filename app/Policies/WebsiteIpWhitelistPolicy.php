<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WebsiteIpWhitelist;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsiteIpWhitelistPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return hasPermission('manage_website_whitelists');
    }

    public function create(User $user): bool
    {
        return hasPermission('manage_website_whitelists');
    }

    public function update(User $user, WebsiteIpWhitelist $websiteIpWhitelist): bool
    {
        return hasPermission('manage_website_whitelists');
    }

    public function delete(User $user, WebsiteIpWhitelist $websiteIpWhitelist): bool
    {
        return hasPermission('manage_website_whitelists');
    }
}