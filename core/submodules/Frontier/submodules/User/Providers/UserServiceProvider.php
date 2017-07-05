<?php

namespace User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
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
    }

    /**
     * Boot the router instance.
     *
     * @return void
     */
    public function bootRouter()
    {
        $this->router = $this->app['router'];
    }
}
