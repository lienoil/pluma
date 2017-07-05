<?php

namespace Single\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SingleServiceProvider extends ServiceProvider
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
        $this->bootViewsExtensions();
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
     * Boot View Composers.
     *
     * @return void
     */
    private function bootComposers()
    {
        //
    }

    /**
     * Boots blade extensions
     *
     * @return void
     */
    private function bootViewsExtensions()
    {
        View::addExtension('html', 'php');
        View::addExtension('template.php', 'blade');
        View::addExtension('component.php', 'blade');
        // View::addExtension('template.php', 'blade');
    }

    public function registerBindings()
    {
        $this->registerExceptionHandlers();
    }
}
