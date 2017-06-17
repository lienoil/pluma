<?php

namespace Pluma\Providers;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootCapsule();
    }

    /**
     * Boot Eloquent
     *
     * @return void
     */
    private function bootCapsule()
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
}
