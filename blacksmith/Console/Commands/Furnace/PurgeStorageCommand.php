<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Pluma\Support\Console\Command;

class PurgeStorageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge:storage
                            {--f|folder= : Which folder in the storage to delete}
                            {--t|truncate : Truncate the storage database table}
                            {--p|preserve : If to preserve the folder specified}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge the public storage folder, and if specified the accompanying database entry';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $option = $this->option();
        $path = $option['folder'] ? storage_path($option['folder']) : storage_path('public');

        $this->info("Purging: $path");

        array_map('unlink', glob("$path/**/*.*"));
        $filesystem->deleteDirectory($path, $option['preserve']);

        exec('composer dump-autoload -o');

        if ((bool) $option['truncate']) {
            \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
            \Illuminate\Support\Facades\DB::table('library')->truncate();
            \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        }

        $this->info("Done.");
    }
}
