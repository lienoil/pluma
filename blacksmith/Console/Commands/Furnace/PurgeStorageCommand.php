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
                            {--t|truncate : Truncate the storage database table}';

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
            $option = $this->option();
            $path = storage_path('public');

            $this->info("Purging storage/public...");

            array_map('unlink', glob("$path/**/*.*"));
            File::cleanDirectory($path);

            exec('composer dump-autoload -o');

            if ((bool) $option['truncate']) {
                \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
                \Illuminate\Support\Facades\DB::table('library')->truncate();
                \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
            }
        } catch (\Pluma\Support\Filesystem\FileAlreadyExists $e) {
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
            $this->error(" ".$e->getMessage()." ");
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
        } catch (\Exception $e) {
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
            $this->error(" ".$e->getMessage()." ");
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
        } finally {
            $this->info("Done.");
        }
    }
}
