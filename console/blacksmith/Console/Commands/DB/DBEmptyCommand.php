<?php

namespace Blacksmith\Console\Commands\DB;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Console\Command;
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
        $this->info('Emptying tables...');

        $tables = explode(',', $this->argument('tables'));

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tables as $table) {
            $table = trim($table);
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
                $this->warn('Another one bites the dust...');
            } else {
              $this->warn("No table `$table` found");
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $this->info('Done.');
    }
}
