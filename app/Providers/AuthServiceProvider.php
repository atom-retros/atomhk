<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\WebsiteArticle;
use App\Models\Wordfilter;
use App\Policies\ArticlePolicy;
use App\Policies\UserPolicy;
use App\Policies\WebsiteArticlePolicy;
use App\Policies\WordfilterPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        WebsiteArticle::class => ArticlePolicy::class,
        Wordfilter::class => WordfilterPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
