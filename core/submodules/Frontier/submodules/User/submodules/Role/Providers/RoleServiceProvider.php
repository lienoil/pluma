<?php

namespace Role\Providers;

use Illuminate\Support\Facades\Schema;
use Pluma\Support\Providers\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Role\Models\Role::class, '\Role\Observers\RoleObserver'],
        [\Role\Models\Grant::class, '\Role\Observers\GrantObserver'],
    ];

    /**
     * Registered middlewares on the
     * Service Providers Level.
     *
     * @var mixed
     */
    protected $middlewares = [
        ['auth.roles' => \Role\Middleware\AuthenticateUserRole::class],
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootObservables();
        $this->bootRouterMiddlewares();
    }
}
