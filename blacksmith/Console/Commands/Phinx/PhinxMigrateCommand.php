<?php

namespace Blacksmith\Console\Commands\Phinx;

use Blacksmith\Console\Commands\Phinx\PhinxBaseCommand;
use Blacksmith\Support\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;

class PhinxMigrateCommand extends Command
{
    use PhinxConfigurable;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'phinx:migrate';

    /**
     * The default command.
     *
     * @var string
     */
    protected $command = 'migrate';

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

        foreach (get_modules_path() as $module) {
            $this->setPhinxConfig($module);
            $this->info(str_pad('=', 80, "="));
            $this->error(str_pad(' ', 80, " "));
            $this->line("Migrating database from $module Module");
            $this->error(str_pad(' ', 80, " "));
            $this->call('migrate'); // The phinx migrate command.
        }
    }
}
