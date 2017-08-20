<?php

namespace Blacksmith\Console\Commands\Phinx;

use Blacksmith\Console\Commands\Phinx\PhinxBaseCommand;
use Blacksmith\Support\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;

class PhinxSeedCreateCommand extends Command
{
    use PhinxConfigurable;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'phinx:seed:create
                            {name=null : The name of the seeder class (e.g. UsersTableSeeder)}
                            ';

    /**
     * The default command.
     *
     * @var string
     */
    protected $command = 'seed:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a seeder class';

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
        $modules = get_modules_path(true);
        $this->setPhinxConfig($modules);

        $message = "Creating Seeder Class";
        $this->info("Using Phinx to create seeder class");
        $this->info(str_pad('=', strlen($message), "="));
        $this->line($message);
        $this->info(str_pad('=', strlen($message), "="));
        $this->call($this->command, ['name' => $this->argument('name')]); // The phinx migrate command.
    }
}
