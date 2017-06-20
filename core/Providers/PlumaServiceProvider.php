<?php

namespace Pluma\Providers;

use Illuminate\Database\Capsule\Manager as Capsule;
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
        $this->capsule();
        $this->composers();
    }

    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindings();
    }

    private function capsule()
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

    private function composers()
    {
        //
    }

    public function bindings()
    {
        $this->registerExceptionHandlers();
    }
}
