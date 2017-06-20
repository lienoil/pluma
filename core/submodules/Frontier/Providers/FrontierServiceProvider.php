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
     * Boot the service.
     *
     * @return void
     */
    public function boot()
    {
        $this->composers();
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

    private function composers()
    {
        $composers = require_config('composers.php');
        view()->composer(['*'], \Pluma\Composers\ApplicationViewComposer::class);
    }
}
