<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WebsiteArticle;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
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
        return hasPermission($user, 'write_article');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WebsiteArticle  $websiteArticle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, WebsiteArticle $websiteArticle)
    {
        return hasPermission($user, 'edit_article');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return hasPermission($user, 'write_article');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WebsiteArticle  $websiteArticle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, WebsiteArticle $websiteArticle)
    {
        return hasPermission($user, 'edit_article');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WebsiteArticle  $websiteArticle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, WebsiteArticle $websiteArticle)
    {
        return hasPermission($user, 'delete_article');
    }
}
