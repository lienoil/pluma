<?php

namespace Frontier\Providers;

use Illuminate\Support\ServiceProvider;

class FrontierServiceProvider extends ServiceProvider
{
    /**
     * The array of view composers.
     *
     * @var array
     */
    protected $composers;

    /**
     * The app's router instance.
     *
     * @var Illuminate\Routing\Router
     */
    protected $router;

    /**
     * Boot the service.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootRouter();

        $this->bootViewComposers();
    }

    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the view composers.
     *
     * @return void
     */
    private function bootViewComposers()
    {
        $composers = require __DIR__.'/../config/composers.php';

        foreach ($composers as $composer) {
            view()->composer($composer['appears'], $composer['class']);
        }
    }

    /**
     * Boot the router instance.
     *
     * @return void
     */
    public function bootRouter()
    {
        $this->router = $this->app['router'];

        $this->router->middleware('auth.admin', \Frontier\Middleware\AuthenticateAdmin::class);
        // $this->router->middleware('roles', CheckRole::class);
        $this->router->middleware('auth.guest', \Frontier\Middleware\RedirectToDashboardIfAuthenticated::class);
    }
}
