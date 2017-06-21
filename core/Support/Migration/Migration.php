<?php

namespace Pluma\Support\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration as Phinx;

class Migration extends Phinx
{
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
        $this->schema();
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
