<?php

namespace Blacksmith\Console\Commands\App;

use Blacksmith\Support\Console\Command;

class AppPathsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:paths
                            {--d|detailed : View other paths.}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Displays the app's paths.";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("<comment>Base path: </comment>" . base_path());

        if ($this->option('detailed')) {
            $this->info("<comment>URL: </comment>" . url('/'));
            $this->info("<comment>Core path: </comment>" . core_path());
            $this->info("<comment>Public path: </comment>" . public_path());
            $this->info("<comment>Modules path: </comment>" . modules_path());
        }
    }
}
