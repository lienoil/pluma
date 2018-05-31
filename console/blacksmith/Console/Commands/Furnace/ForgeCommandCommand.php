<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Support\Facades\File;
use Blacksmith\Support\Console\Command;
use Pluma\Support\Filesystem\Filesystem;

class ForgeCommandCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:command
                           {name : The class name of the blacksmith command.}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a blacksmith console command.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        // TODO: forge:command
        $this->info('command not finished yet');
    }
}
