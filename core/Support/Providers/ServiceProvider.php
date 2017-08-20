<?php

namespace Pluma\Support\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Pluma\Support\Installation\Traits\AppIsInstalled;

class ServiceProvider extends BaseServiceProvider
{
    use AppIsInstalled;

    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        //
    ];

    /**
     * Registered middlewares on the
     * Service Providers Level.
     *
     * @var mixed
     */
    protected $middlewares = [
        //
    ];

    /**
     * Bootstraps the Observables.
     *
     * @return void
     */
    public function bootObservables()
    {
        if ($this->appIsInstalled()) {
            foreach ($this->observables() as $observable) {
                if (Schema::hasTable(with($this->app->make($observable[0]))->getTable())) {
                    $model = $this->app->make($observable[0]);
                    $observer = $this->app->make($observable[1]);
                    $model::observe(new $observer);
                }
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
