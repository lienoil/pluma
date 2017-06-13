<?php

namespace Pluma\Providers;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\ServiceProvider;
use Pluma\Support\Handlers\ExceptionHandler;

class PlumaServiceProvider extends ServiceProvider
{
    use ExceptionHandler;

    protected $capsule;

    public function boot()
    {
        $this->capsule();
    }

    public function register()
    {
        // $this->app->register(Pluma\Providers\ModuleServiceProvider::class);
        // $this->app->register(Pluma\Providers\FilesystemServiceProvider::class);
        $this->bindings();
    }

    private function capsule()
    {
        $this->capsule = new Capsule();
        $this->capsule->addConnection([
            'driver'    => env('DB_CONNECTION', 'mysql'),
            'host'      => env('DB_HOST', 'localhost'),
            'database'  => env('DB_NAME', 'pluma_db'),
            'username'  => env('DB_USER', 'root'),
            'password'  => env('DB_PASSWORD', 'root'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    public function bindings()
    {
        $this->registerExceptionHandlers();
    }

}
