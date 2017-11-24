<?php

namespace Page\Providers;

use Pluma\Support\Providers\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Page\Models\Page::class, '\Page\Observers\PageObserver'],
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

    protected $composers = [
        //
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootComposers();

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

    /**
     * Boots the composers variable
     *
     * @return void
     */
    public function bootComposers()
    {
        if (file_exists(__DIR__."/../config/composers.php")) {
            $this->composers = require_once __DIR__."/../config/composers.php";
        }
    }
}
