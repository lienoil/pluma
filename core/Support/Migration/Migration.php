<?php

namespace Pluma\Support\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration as Phinx;

class Migration extends Phinx
{
    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    public $capsule;

    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    public $schema;

    /**
     * Initialize the migration
     *
     * @return void
     */
    public function init()
    {
        $this->setCapsule();
        $this->setSchema();
    }

    /**
     * Set the database manager. Boot up Eloquent
     *
     * @param Illuminate\Database\Capsule\Manager $capsule
     * @return void
     */
    public function setCapsule(Capsule $capsule)
    {
        $this->capsule = $capsule;
        $this->capsule->addConnection([
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_NAME', 'pluma_db'),
            'username' => env('DB_USER', 'root'),
            'password' => env('DB_PASSWORD', 'root'),
            'charset' => env('DB_CHARSET', 'utf8'),
            'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
        ]);
        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
    }

    /**
     * Set the Schema instance.
     *
     * @return void
     */
    public function setSchema()
    {
        $this->schema = $this->capsule->schema();
    }

    /**
     * Get the Capsule instance.
     *
     * @return \Illuminate\Database\Capsule\Manager
     */
    public function getCapsule()
    {
        return $this->capsule;
    }

    /**
     * Get the Schema instance.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    public function getSchema()
    {
        return $this->schema;
    }
}
