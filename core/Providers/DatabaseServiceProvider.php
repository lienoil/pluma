<?php

namespace Pluma\Providers;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DatabaseServiceProvider as ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    public $schema;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->bootCapsule();

        $this->bootSchema();
    }

    /**
     * Boot Eloquent.
     *
     * @return void
     */
    private function bootCapsule()
    {
        $this->capsule = new Capsule();
        $this->capsule->addConnection([
            'driver' => config('DB_CONNECTION', env('DB_CONNECTION', 'mysql')),
            'host' => config('DB_HOST', env('DB_HOST', 'localhost')),
            'database' => config('DB_DATABASE', env('DB_DATABASE', 'pluma')),
            'username' => config('DB_USERNAME', env('DB_USERNAME', 'pluma')),
            'password' => config('DB_PASSWORD', env('DB_PASSWORD', 'pluma')),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();

        $this->app->capsule = $this->capsule;
    }

    /**
     * Boot Schema.
     *
     * @return void
     */
    private function bootSchema()
    {
        $this->schema = $this->capsule->schema();
    }
}
