<?php

namespace Pluma\Database\Migrations;

use Phinx\Migration\AbstractMigration as Phinx;
use Pluma\Provider\Capsule;

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

    public function init()
    {
        $this->setCapsule();
        $this->setSchema();
    }

    public function setCapsule(Capsule $capsule)
    {
        $this->capsule = $capsule;
        $this->capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => '127.0.0.1',//DB_HOST,
            'port'      => '',//DB_PORT,
            'database'  => 'pluma_db',//DB_NAME,
            'username'  => 'root',//DB_USER,
            'password'  => 'root',//DB_PASSWORD,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
    }

    public function setSchema()
    {
        $this->schema = $this->capsule->schema();
    }
}