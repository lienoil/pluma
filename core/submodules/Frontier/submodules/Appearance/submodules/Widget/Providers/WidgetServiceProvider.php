<?php

namespace Widget\Providers;

use Pluma\Support\Providers\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Widget\Models\Widget::class, '\Widget\Observers\WidgetObserver'],
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
        $this->bootViewComposersConfigurationFile();

        parent::boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Boots the composers variable
     *
     * @return void
     */
    public function bootViewComposersConfigurationFile()
    {
        if (file_exists(__DIR__."/../config/composers.php")) {
            $this->composers = require_once __DIR__."/../config/composers.php";
        }
    }
}
