<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Contracts\Admin\CommentRepository::class, \App\Repositories\Eloquent\Admin\CommentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\Admin\BlogRepository::class, \App\Repositories\Eloquent\Admin\BlogRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\Admin\MenuRepository::class, \App\Repositories\Eloquent\Admin\MenuRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\Admin\PermissionRepository::class, \App\Repositories\Eloquent\Admin\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\Admin\ComposeRepository::class, \App\Repositories\Eloquent\Admin\ComposeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\Admin\RoleRepository::class, \App\Repositories\Eloquent\Admin\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\Admin\ControRepository::class, \App\Repositories\Eloquent\Admin\ControRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\Admin\PposRepository::class, \App\Repositories\Eloquent\Admin\PposRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\Admin\UserRepository::class, \App\Repositories\Eloquent\Admin\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\Admin\UserRoleRepository::class, \App\Repositories\Eloquent\Admin\UserRoleRepositoryEloquent::class);
        //:end-bindings:
    }
}
