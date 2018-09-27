<?php

namespace Assignment\Providers;

use Pluma\Support\Providers\ServiceProvider;


class AssignmentServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
    ];

    /**
     * Registered middlewares on the
     * Service Providers Level.
     *
     * @var mixed
     */
    protected $middleware = [
    ];

    /**
     * Boostrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootComposers();

        $this->bootObservables();

        parent::boot();
    }

    /**
     * Register the service providers.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function bootComposers()
    {
        if (file_exists(__DIR__."/../config/composers.php")) {
            $this->composers = require_once __DIR__."/../config/composers.php";
        }
    }
}
