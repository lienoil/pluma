<?php

namespace Frontier\Providers;

use Illuminate\Support\ServiceProvider;

class FrontierServiceProvider extends ServiceProvider
{
    /**
     * Basename for the modules.
     *
     * @var string
     */
    protected $basename = 'Frontier';

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

        $this->router->aliasMiddleware('auth.admin', \Frontier\Middleware\AuthenticateAdmin::class);
        $this->router->aliasMiddleware('auth.guest', \Frontier\Middleware\RedirectToDashboardIfAuthenticated::class);
        // $this->router->aliasMiddleware('auth.roles', AuthenticateRole::class);
    }
}
