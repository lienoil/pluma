<?php

namespace Pluma\Provider;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\ServiceProvider;

class PlumaServiceProvider extends ServiceProvider
{
    protected $capsule;

    public function boot()
    {
        $this->capsule();
        $this->routes();
    }

    public function register()
    {
        $this->app->register("Pluma\Providers\ModuleServiceProvider");
    }

    private function capsule()
    {
        $this->capsule = new Capsule();
        $this->capsule->addConnection([
            'driver'    => env('DB_DRIVER', 'mysql'),
            'host'      => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'pluma_db'),
            'username'  => env('DB_USERNAME', 'root'),
            'password'  => env('DB_PASSWORD', 'root'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    private function routes()
    {
        // Pluma's own routes
        if (file_exists($this->app->getRealPath().'/core/routes/admin.php')) {
            require_once $this->app->getRealPath().'/core/routes/admin.php';
        }
    }
}
