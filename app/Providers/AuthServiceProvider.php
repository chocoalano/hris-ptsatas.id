<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Config\Role::class => \App\Policies\RolePolicy::class,
        \App\Models\Config\Permission::class => \App\Policies\PermissionPolicy::class,
        \App\Models\Config\Team::class => \App\Policies\TeamPolicy::class,

        \App\Models\Project\ProjectManagement::class => \App\Policies\Project\ProjectListPolicy::class,
        \App\Models\Project\ProjectTask::class => \App\Policies\Project\ProjectTaskPolicy::class,
        \App\Models\Sales\Customer::class => \App\Policies\Project\CustomerPolicy::class,

        \App\Models\Blogs\Post::class => \App\Policies\Blogs\PostPolicy::class,
        \App\Models\Blogs\PostCategory::class => \App\Policies\Blogs\PostCategoryPolicy::class,

        \App\Models\Assets\Document::class => \App\Policies\Asset\DocumentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
