<?php

namespace Blacksmith\Console\Commands\Phinx;

use Illuminate\Support\Facades\File;
use Phinx\Config\Config as PhinxConfig;
use Symfony\Component\Console\Question\ChoiceQuestion;

trait PhinxConfigurable
{
    /**
     * Sets the Default Phinx Config
     *
     * @param mixed $current
     */
    public function setPhinxConfig($current = null)
    {
        $command = $this->getApplication()->find($this->command);
        $environment = $this->environment;
        $migrations = base_path("database/migrations");
        $seeds = base_path("database/seeds");

        switch (get_class($command)) {
            case 'Phinx\Console\Command\Create':
            case 'Phinx\Console\Command\SeedCreate':
                $name = $this->argument('name');
                $modules = get_modules_path(true); // basename only
                if ('null' == $name || null == $name) {
                    $name = $this->ask('Please specify the migration class name (e.g. CreateQuestsTable)');
                    $this->input->setArgument('name', $name);
                }

                $question = new ChoiceQuestion(
                    "Which module do you want to save this <info>$name</info> migration?",
                    $modules
                );

                $module = $command->getHelper('question')->ask($this->input, $this->output, $question);
                $module = get_module($module);

                $migrations = "$module/database/migrations";
                if (! is_dir($migrations)) {
                    File::makeDirectory($migrations, 0755, true, true);
                }

                $seeds = "$module/database/seeds";
                if (! is_dir($seeds)) {
                    File::makeDirectory($seeds, 0755, true, true);
                }

                if (! is_dir($migrations)) {
                    dd(File::makeDirectory($migrations, 0755, true, true));
                }
                break;

            case 'Phinx\Console\Command\Migrate':
            default:
            // dd('asdasd');
                $migrations = "$current/database/migrations";
                $seeds      = "$current/database/seeds";
                break;
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
                'file' => base_path('blacksmith/templates/migrations/updown-migration.stub'),
            ],
        ]);

        $command->setConfig($config);
    }
}
