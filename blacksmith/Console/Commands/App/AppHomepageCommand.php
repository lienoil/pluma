<?php

namespace Blacksmith\Console\Commands\App;

use Blacksmith\Support\Console\Command;

class AppHomepageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:homepage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Displays the app's homepage.";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(url('/'));
    }
}
