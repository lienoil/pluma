<?php

namespace Role\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Providers\ServiceProvider;
use Role\Models\Permission;

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
        $this->bootGate();
        $this->bootObservables();
        $this->bootRouterMiddlewares();
    }

    /**
     * Registers the Permissions as Gate policies.
     *
     * @return void
     */
    public function bootGate()
    {
        if (Schema::hasTable('permissions')) {
            foreach (Permission::get() as $permission) {
                Gate::define($permission->code, function ($user) use ($permission) {
                    return user()->isRoot() || $user->isPermittedTo($permission->code);
                });
            }
        }
    }
}
