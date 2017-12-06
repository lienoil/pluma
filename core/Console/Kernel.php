<?php

namespace Pluma\Console;

use Illuminate\Console\Scheduling\Schedule;
use Pluma\Support\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Blacksmith
        \Blacksmith\Console\Commands\Furnace\ForgeModuleCommand::class,
        \Blacksmith\Console\Commands\Furnace\ForgeWeaponCommand::class,
        \Blacksmith\Console\Commands\Phinx\PhinxMigrateCreateCommand::class,
        \Blacksmith\Console\Commands\Phinx\PhinxMigrateRunCommand::class,
        \Blacksmith\Console\Commands\Phinx\PhinxSeedCreateCommand::class,
        \Blacksmith\Console\Commands\Phinx\PhinxSeedRunCommand::class,

        // vendor
        \Phinx\Console\Command\Init::class,
        \Phinx\Console\Command\Create::class,
        \Phinx\Console\Command\Migrate::class,
        \Phinx\Console\Command\Rollback::class,
        \Phinx\Console\Command\Status::class,
        \Phinx\Console\Command\Breakpoint::class,
        \Phinx\Console\Command\Test::class,
        \Phinx\Console\Command\SeedCreate::class,
        \Phinx\Console\Command\SeedRun::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(core_path('routes/console.php'));
    }
}
