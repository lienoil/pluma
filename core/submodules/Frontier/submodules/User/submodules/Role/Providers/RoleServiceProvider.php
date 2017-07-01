<?php

namespace Role\Providers;

use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * The array of view composers.
     *
     * @var array
     */
    protected $composers;

    /**
     * Boot the service.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootComposers();
    }

    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    private function bootComposers()
    {
        //
    }

    public function registerBindings()
    {
        //
    }
}
