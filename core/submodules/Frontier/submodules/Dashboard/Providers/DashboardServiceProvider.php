<?php

namespace Dashboard\Providers;

use Pluma\Support\Providers\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
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
        parent::boot();
    }
}
