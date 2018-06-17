<?php

namespace Blacksmith\Console\Commands\DB;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
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
                           {--t|tables= : The table to truncate. If multiple, separate by comma, enclose in quotations}
                           {--a|all : Drop all tables including the migrations table}
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
        $tables = explode(',', $this->option('tables'));

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        if ($this->option('all')) {
            if (! $this->confirm("You are about to drop all tables. Are you sure?", false)) {
                $this->info("Command aborted");
                exit();
            }

            $this->dropAllTables();
        } else {
            $this->dropTable($tables);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /**
     * Drop all tables from database.
     *
     * @return void
     */
    public function dropAllTables()
    {
        foreach (DB::select('SHOW TABLES') as $table) {
            $table = get_object_vars($table);
            $name = $table[key($table)];
            $this->info("Dropping table `$name`");
            Schema::drop($name);
        }

        $this->info("All tables were dropped.");
    }

    /**
     * Drop specific tables.
     *
     * @return void
     */
    public function dropTable($tables)
    {
        foreach ($tables as $table) {
            $table = trim($table);
            $this->info("Dropping table $table");

            if (Schema::hasTable($table)) {
                Schema::dropIfExists($table);
                $this->warn('Another one bites the dust...');
            } else {
                $this->warn("No table named `$table` found.");
                break;
            }

            // Remove from migrations table
            $className = "Create".studly_case($table)."Table";
            DB::table(config('database.migrations'))->where('migration_name', '=', $className)->delete();
        }
    }
}
