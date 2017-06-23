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
    protected $modules;

    public function migrate($modules = null)
    {
        $this->modules = is_null($modules) ? modules(true, null, false) : $modules;

        foreach ($this->modules as $name => $module) {
            if (is_array($module)) {
                $this->migrate($module);

                $module = $name;
            }

            foreach (get_migrations() as $migrationPath) {
                $this->execute($migrationPath);
            }
        }

        return $this;
    }

    public function execute($migrationsPath)
    {
        config()->set('migrations.paths.migrations', [$migrationsPath]);
        config()->set('migrations.environments.'.env('APP_ENV'), $this->getConfig());

        $migration = new PhinxApplication();
        $wrapper = new TextWrapper($migration);

        if (! is_dir(base_path('tmp'))) File::makeDirectory(base_path('tmp'));
        File::put(base_path('tmp/c.php'), '<?php return '.var_export(config('migrations'), true) . ';');

        $wrapper->setOption('configuration', base_path('tmp/c.php'));
        $wrapper->setOption('parser', 'php');
        $wrapper->setOption('environment', env('APP_ENV'));

        $log = $wrapper->getMigrate();

        File::deleteDirectory(base_path('tmp'));
    }

    public function getConfig()
    {
        return [
            'adapter' => config('DB_CONNECTION', env('DB_CONNECTION', 'mysql')),
            'host' => config('DB_HOST', env('DB_HOST', 'localhost')),
            'name' => config('DB_DATABASE', env('DB_DATABASE', 'pluma_db')),
            'user' => config('DB_USERNAME', env('DB_USERNAME', 'root')),
            'pass' => config('DB_PASSWORD', env('DB_PASSWORD', '')),
            'port' => config('DB_PORT', env('DB_PORT')),
        ];
    }
}
