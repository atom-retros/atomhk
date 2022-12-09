<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WebsiteArticle;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return hasPermission('write_article');
    }

    public function view()
    {
        return hasPermission('edit_article');
    }

    public function create()
    {
        return hasPermission('write_article');
    }

    public function update()
    {
        return hasPermission('edit_article');
    }

    public function delete()
    {
        return hasPermission('delete_article');
    }
}
