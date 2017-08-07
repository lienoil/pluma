<?php

namespace Pluma\Support\Database\Traits;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PDO;
use Phinx\Console\PhinxApplication;
use Phinx\Wrapper\TextWrapper;

trait MigrateDatabase
{
    protected $migrations;

    public function migrate($migrations = null, $request = null)
    {
        $this->migrations = is_null($migrations) ? get_migrations(modules(true, null, false), config('path.migrations')) : $migrations;

        foreach ($this->migrations as $name => $migration) {
            if (is_array($migration)) {
                if (! empty($migration)) {
                    $this->migrate($migration, $request);
                    // $this->execute($migration, $request);
                }

                $this->execute($name, $request);
            } else {
                $this->execute($migration, $request);
            }

        }

        return $this;
    }

    public function execute($migrationsPath, $request)
    {
        $migration = new PhinxApplication();
        $wrapper = new TextWrapper($migration);

        foreach (glob("$migrationsPath/*.php") as $migration) {
            $basename = basename($migration);
            File::copy($migration, base_path("database/migrations/$basename"));
        }

        $wrapper->setOption('configuration', base_path('config/migrations.php'));
        $wrapper->setOption('parser', 'php');
        $wrapper->setOption('environment', env('APP_ENV'));

        $log = $wrapper->getMigrate();
    }

    public function getConfig($request)
    {
        return [
            'adapter' => config('DB_CONNECTION', env('DB_CONNECTION', 'mysql')),
            'host' => config('DB_HOST', env('DB_HOST', 'localhost')),
            'name' => config('DB_DATABASE', env('DB_DATABASE', $request->input('DB_DATABASE'))),
            'user' => config('DB_USERNAME', env('DB_USERNAME', $request->input('DB_USERNAME'))),
            'pass' => config('DB_PASSWORD', env('DB_PASSWORD', $request->input('DB_PASSWORD'))),
            'port' => config('DB_PORT', env('DB_PORT')),
        ];
    }
}
