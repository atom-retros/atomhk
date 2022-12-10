<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WebsiteIpBlacklist;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsiteIpBlacklistPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return hasPermission('manage_website_blacklists');
    }

    public function create(User $user): bool
    {
        return hasPermission('manage_website_blacklists');
    }

    public function update(User $user, WebsiteIpBlacklist $websiteIpBlacklist): bool
    {
        return hasPermission('manage_website_blacklists');
    }

    public function delete(User $user, WebsiteIpBlacklist $websiteIpBlacklist): bool
    {
        return hasPermission('manage_website_blacklists');
    }
}