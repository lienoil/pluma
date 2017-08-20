<?php

namespace Blacksmith\Console\Commands\Phinx;

use Blacksmith\Console\Commands\Phinx\PhinxBaseCommand;
use Blacksmith\Support\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;

class PhinxMigrateRunCommand extends Command
{
    use PhinxConfigurable;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'phinx:migrate:run';

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
        $modules = get_modules_path();
        $this->setPhinxConfig($modules);

        $message = "Migrating database from all Module";
        $this->info("Using Phinx to migrate");
        $this->info(str_pad('=', strlen($message), "="));
        $this->error(str_pad(' ', strlen($message), " "));
        $this->line($message);
        $this->error(str_pad(' ', strlen($message), " "));
        $this->info(str_pad('=', strlen($message), "="));
        $this->call($this->command, $this->getOptions()); // The phinx migrate command.
    }
}
