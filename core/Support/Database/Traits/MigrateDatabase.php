<?php

namespace Pluma\Support\Database\Traits;

use Illuminate\Support\Facades\Artisan;

trait MigrateDatabase
{
    /**
     * Array of migrations to migrate.
     *
     * @var array
     */
    protected $migrations;

    /**
     * Perform the migrate.
     *
     * @return void
     */
    public function migrate()
    {
        try {
            Artisan::call('phinx:migrate:run');
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return true;
    }
}
