<?php

namespace Pluma\Providers;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\DatabaseServiceProvider as BaseDatabaseServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Events\Dispatcher;

class DatabaseServiceProvider extends BaseDatabaseServiceProvider
{
    /**
     * The schema instance
     *
     * @var \Illuminate\Support\Facades\Schema
     */
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
        $connection = config('database.default');

        $driver = config("database.connections.$connection.driver", env('DB_CONNECTION', 'mysql'));
        $host = config("database.connections.$connection.host", env('DB_HOST', '127.0.0.1'));
        $port = config("database.connections.$connection.port", env('DB_PORT', '3306'));
        $database = config("database.connections.$connection.database", env('DB_DATABASE', 'pluma'));
        $username = config("database.connections.$connection.username", env('DB_USERNAME', 'pluma'));
        $password = config("database.connections.$connection.password", env('DB_PASSWORD', 'pluma'));

        $this->capsule = new Capsule();
        $this->capsule->addConnection([
            'driver' => $driver,
            'host' => $host,
            'database' => $database,
            'username' => $username,
            'password' => $password,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
        ]);

        // Set global, instance available globally via static methods
        $this->capsule->setAsGlobal();
        // Start
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
