<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Filesystem\Filesystem;
use Pluma\Support\Console\Command;

class PurgeStorageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge:storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge the public storage folder';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        try {
            $this->line("Purging storage/public...");
            $filesystem->deleteDirectory(storage_path('public'), $preservedTopLevelDirectory = true);
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
