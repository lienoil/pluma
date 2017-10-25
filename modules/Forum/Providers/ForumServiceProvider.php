<?php

namespace Forum\Providers;

use Forum\Models\Forum;
use Forum\Observers\ForumObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ForumServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Forum\Models\Forum::class, '\Forum\Observers\ForumObserver'],
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
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
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
     * Boots the router middleware.
     *
     * @return void
     */
    public function bootRouterMiddlewares()
    {
        $router = $this->app['router'];
        foreach ($this->middlewares() as $key => $class) {
            $router->aliasMiddleware($key, $class);
        }
    }

    /**
     * Gets the array of observables.
     *
     * @return array
     */
    protected function observables()
    {
        return $this->observables;
    }

    /**
     * Gets the array of middlewares.
     *
     * @return array
     */
    protected function middlewares()
    {
        return $this->middlewares;
    }
}
