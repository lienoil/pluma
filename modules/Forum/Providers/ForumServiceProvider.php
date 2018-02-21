<?php

namespace Forum\Providers;

use Illuminate\Support\Facades\Schema;
use Pluma\Support\Providers\ServiceProvider;

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
        parent::register();
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
