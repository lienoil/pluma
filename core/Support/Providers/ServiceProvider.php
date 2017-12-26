<?php

namespace Pluma\Support\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Pluma\Support\Installation\Traits\AppIsInstalled;

class ServiceProvider extends BaseServiceProvider
{
    use AppIsInstalled;

    /**
     * Array of view composers to register.
     *
     * @var array
     */
    protected $composers = [
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
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        //
    ];

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     * Array of providers to register.
     *
     * @var array
     */
    protected $providers = [
        //
    ];

    /**
     * Boot the service provider
     *
     * @return void
     */
    public function boot()
    {
        $this->bootObservables();

        $this->bootPolicies();

        $this->bootRouterMiddlewares();

        $this->bootViewComposers();
    }

    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();
    }

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
     * Boots the view composers.
     *
     * @return void
     */
    public function bootViewComposers()
    {
        $composers = $this->composers;

        foreach ($composers as $composer) {
            view()->composer($composer['appears'], $composer['class']);
        }
    }

    /**
     * Register the application's policies.
     *
     * @return void
     */
    public function bootPolicies()
    {
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
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

    /**
     * Register additional Providers through this Provider.
     *
     * @return void
     */
    public function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}
