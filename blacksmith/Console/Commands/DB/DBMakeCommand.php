<?php

namespace Blacksmith\Console\Commands\DB;

use Blacksmith\Support\Console\Command;
use Illuminate\Support\Facades\File;
use Pluma\Support\Filesystem\Filesystem;

class DBMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:make
                            {migration : The name of the migration file}
                            {--m|module=none : Specify the module it belongs to, if applicable}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a database migration file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $this->call('phinx:migrate:create', ['name' => $this->argument('migration')]);

        $this->info('Done.');
    }
}
