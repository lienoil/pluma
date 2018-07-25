<?php

namespace Blacksmith\Console\Commands\DB;

use Blacksmith\Support\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Filesystem\Filesystem;

class DBEmptyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:truncate
                           {tables : The tables to truncate, separated by comma, enclosed in quotations}
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
     * @return DB
     * @return mixed
     * @return Schema
     */
    public function handle(Filesystem $filesystem)
    {
        $n = microtime(true);

        $tables = explode(',', $this->argument('tables'));

        Schema::disableForeignKeyConstraints();

        foreach ($tables as $table) {
            $table = trim($table);
            if (! Schema::hasTable($table)) {
                $this->warn("No table `$table` found");
                continue;
            }

            $this->warn("Truncating: Table `{$table}`...");
            DB::table($table)->truncate();
            $this->info("Truncated: Table `{$table}`");
        }

        Schema::enableForeignKeyConstraints();

        $this->info('Took '.$this->time($n).' to finish the command.');
    }
}
