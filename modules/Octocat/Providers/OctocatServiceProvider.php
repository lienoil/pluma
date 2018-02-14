<?php

namespace Octocat\Providers;

use Pluma\Support\Providers\ServiceProvider;

class OctocatServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Octocat\Models\Octocat::class, '\Octocat\Observers\OctocatObserver'],
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
        parent::boot();
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
}
