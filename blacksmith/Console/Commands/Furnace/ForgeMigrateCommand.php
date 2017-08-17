<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Filesystem\Filesystem;
use Phinx\Config\Config as PhinxConfig;
use Pluma\Support\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ForgeMigrateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'forge:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the database migrations';

    /**
     * Default environment.
     *
     * @var string
     */
    protected $environment = 'development';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $file)
    {
        $this->info("Using Phinx to migrate");
        $this->setPhinxConfig();

        foreach (get_modules_path() as $module) {
            $this->info('================================================');
            $this->info('Migrating database from '.basename($module));
            $this->migrate($module);
            $this->info('================================================');
        }
    }

    public function migrate($module)
    {
        $this->call('migrate');
    }

    public function setPhinxConfig()
    {
        $command = $this->getApplication()->find('migrate');
        $environment = $this->environment;
        $migrations = base_path("database/migrations");
        $seeds = base_path("database/seeds");

        switch (get_class($command)) {
            case 'Phinx\Console\Command\Create':
            case 'Phinx\Console\Command\SeedCreate':
                $modules = get_modules_path(true); // basename only
                $question = new ChoiceQuestion(
                    'Which module do you want to save this migration?',
                    $modules
                );
                $module = $command->getHelper('question')->ask($input, $output, $question);
                $migrations = $root."/*/$module/database/migrations";
                $seeds      = $root."/*/$module/database/seeds";
                break;
            case 'Phinx\Console\Command\Migrate':
                # code...
                break;
            default:
                $migrations = [$root.'/database/migrations', $root.'/*/*/database/migrations'];
                $seeds      = [$root.'/database/seeds', $root.'/*/*/database/seeds'];
        }

        $config = new PhinxConfig([
            'environments' => [
                'default_migration_table' => config('database.migrations', 'migrations'),
                'default_database'        => $environment,
                $environment              => [
                    'adapter' => env('DB_CONNECTION'),
                    'host' => env('DB_HOST'),
                    'name' => env('DB_DATABASE'),
                    'user' => env('DB_USERNAME', 'root'),
                    'pass' => env('DB_PASSWORD', 'root'),
                    'port' => env('DB_PORT', 3306),
                    'charset' => env('DB_CHARSET', 'utf8'),
                ]
            ],
            'paths' => [
                'migrations' => $migrations,
                'seeds'      => $seeds
            ],
            'templates' => [
                'file' => __DIR__.'/templates/migrations/updown-migration.stub'
            ],
        ]);

        $command->setConfig($config);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['configuration', null, InputOption::VALUE_OPTIONAL, 'The default configurations to use.'],

        ];
    }
}
