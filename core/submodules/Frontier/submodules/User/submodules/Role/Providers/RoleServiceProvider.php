<?php

namespace Role\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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

    /**
     * Bootstraps the Observables.
     *
     * @return void
     */
    public function bootObservables()
    {
        foreach ($this->observables() as $observable) {
            if (Schema::hasTable(with($this->app->make($observable[0]))->getTable())) {
                $model = $this->app->make($observable[0]);
                $observer = $this->app->make($observable[1]);
                $model::observe(new $observer);
            }
        }
    }

    /**
     * Boots the router middleware
     *
     * @return void
     */
    public function bootRouterMiddlewares()
    {
        $router = $this->app['router'];
        foreach ($this->middlewares() as $name => $class) {
            $router->aliasMiddleware($name, $class);
        }
    }

    /**
     * Gets the array of observables.
     *
     * @return array
     */
    public function observables()
    {
        return $this->observables;
    }

    /**
     * Gets the array of middlewares.
     *
     * @return array
     */
    public function middlewares()
    {
        return $this->middlewares;
    }
}
