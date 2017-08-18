<?php

namespace Blacksmith\Console\Commands\Phinx;

use Blacksmith\Console\Commands\Phinx\PhinxBaseCommand;
use Blacksmith\Support\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;

class PhinxCreateCommand extends Command
{
    use PhinxConfigurable;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'phinx:create
                            {name=null : The name of the file}
                            {-t|table=null : The name of the database table}
                            ';

    /**
     * The default command.
     *
     * @var string
     */
    protected $command = 'create';

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
        $this->setPhinxConfig();

        $this->call($this->command, ['name' => $this->argument('name')]); // The phinx migrate command.
    }
}
