<?php

namespace Pluma\Support\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{
    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    public $schema;

    public $capsule;

    /**
     * Initialize the migration
     *
     * @return void
     */
    public function init()
    {
        $this->capsule();
        $this->schema();
    }

    /**
     * Boot Eloquent.
     *
     * @return void
     */
    private function capsule()
    {
        $this->capsule = new Capsule();

        $this->capsule->addConnection([
            'driver'    => config('DB_CONNECTION', env('DB_CONNECTION', 'mysql')),
            'host'      => config('DB_HOST', env('DB_HOST', 'localhost')),
            'database'  => config('DB_DATABASE', env('DB_DATABASE', 'pluma')),
            'username'  => config('DB_USERNAME', env('DB_USERNAME', 'pluma')),
            'password'  => config('DB_PASSWORD', env('DB_PASSWORD', 'pluma')),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    /**
     * Set the Schema instance.
     *
     * @return void
     */
    public function schema()
    {
        $this->schema = $this->capsule->schema();
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
