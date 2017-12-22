<?php

namespace Pluma\Providers;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Queue\Capsule\Manager as Queue;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Pluma\Support\Handlers\ExceptionHandler;

class PlumaServiceProvider extends ServiceProvider
{
    use ExceptionHandler;

    /**
     * Eloquent instance.
     *
     * @var Illuminate\Database\Capsule\Manager
     */
    protected $capsule;

    /**
     * Queue instance.
     *
     * @var \Illuminate\Queue\Capsule\Manager
     */
    protected $queue;

    /**
     * The array of view composers.
     *
     * @var array
     */
    protected $composers;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootCapsule();

        $this->bootViewsExtensions();

        $router = $this->app['router'];
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

    private function bootCapsule()
    {
        $this->capsule = new Capsule();
        $this->capsule->addConnection([
            'driver' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', 'localhost'),
            'database' => env('DB_NAME', 'pluma_db'),
            'username' => env('DB_USER', 'root'),
            'password' => env('DB_PASSWORD', 'root'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    /**
     * Boots blade extensions
     *
     * @return void
     */
    private function bootViewsExtensions()
    {
        View::addExtension('template.php', 'blade');
    }

    /**
     * Register bindings.
     *
     * @return void
     */
    public function registerBindings()
    {
        // $this->registerExceptionHandlers();
    }
}
