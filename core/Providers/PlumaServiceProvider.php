<?php

namespace Pluma\Providers;

use Illuminate\Database\Capsule\Manager as Capsule;
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
        $this->bootCapsule();
        $this->bootComposers();
        $this->bootViewsExtensions();

        $router = $this->app['router'];
        // $router->middleware('auth.admin', \Frontier\Middleware\AuthenticateAdmin::class);
        echo "<pre>";
            dd( $router->getMiddleware() ); die();
        echo "</pre>";
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
        View::addExtension('template.php', 'blade');
    }

    public function registerBindings()
    {
        $this->registerExceptionHandlers();
    }
}
