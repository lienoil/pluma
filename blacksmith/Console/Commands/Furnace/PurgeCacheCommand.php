<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Filesystem\Filesystem;
use Pluma\Support\Console\Command;

class PurgeCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge the storage folder, cache, compiled folder, session';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        try {
            $this->line("Clearing cache...");
            $filesystem->deleteDirectory(storage_path('compiled/sessions'), $preservedTopLevelDirectory = true);
            $filesystem->deleteDirectory(storage_path('compiled/views'), $preservedTopLevelDirectory = true);
            $filesystem->deleteDirectory(storage_path('framework/cache'), $preservedTopLevelDirectory = true);
            $filesystem->put(storage_path('compiled/sessions/.gitignore'), "!\n*");
            $filesystem->put(storage_path('compiled/views/.gitignore'), "!\n*");
            $filesystem->put(storage_path('framework/cache/.gitignore'), "!\n*");
            exec('composer dump-autoload -o');
        } catch (\Pluma\Support\Filesystem\FileAlreadyExists $e) {
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
            $this->error(" ".$e->getMessage()." ");
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
        } catch (\Exception $e) {
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
            $this->error(" ".$e->getMessage()." ");
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
        } finally {
            $this->line("Done.");
        }
    }
}
