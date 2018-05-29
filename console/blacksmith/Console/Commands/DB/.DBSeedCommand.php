<?php

namespace Blacksmith\Console\Commands\DB;

use Illuminate\Support\Facades\File;
use Pluma\Support\Console\Command;
use Pluma\Support\Filesystem\Filesystem;

class SSSSSDBSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeding the database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $this->info("Migrating");

        $this->call('phinx:seed:run');

        $this->info('Done.');
    }
}
