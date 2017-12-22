<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Filesystem\Filesystem;
use Pluma\Support\Console\Command;

class PurgeViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge the compiled views from storage';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $this->line("Clearing cached views from /storage/compiled/views...");

        $path = storage_path('compiled/views');

        $restrictedFiles = ['.gitignore', '.gitkeep'];

        foreach (glob("$path/**") as $file) {
            if (! in_array(basename($file), $restrictedFiles)) {
                $filesystem->delete($file);
            }
        }

        $this->info("Done.");
    }
}
