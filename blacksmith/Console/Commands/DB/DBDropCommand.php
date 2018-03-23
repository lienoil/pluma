<?php

namespace Blacksmith\Console\Commands\DB;

use Illuminate\Support\Facades\File;
use Pluma\Support\Console\Command;
use Pluma\Support\Filesystem\Filesystem;

class DBDropCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:drop
                           {table : The table to truncate. If multiple, separate by comma, enclose in quotations}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate the tables specified';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $tables = explode(',', $this->argument('table'));

        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tables as $table) {
            $table = trim($table);
            $this->info("Dropping table $table");

            if (\Illuminate\Support\Facades\Schema::hasTable($table)) {
                // Drop table
                \Illuminate\Support\Facades\Schema::dropIfExists($table);

                $this->warn('Another one bites the dust...');
            }

            // Remove from migrations table
            $className = "Create".studly_case($table)."Table";
            \Illuminate\Support\Facades\DB::table(config('database.migrations'))->where('migration_name', '=', $className)->delete();
        }
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $this->info('Done.');
    }
}
