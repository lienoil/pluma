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
        //
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

    /**
     * Require a file.
     *
     * @param  string $command
     * @return void
     */
    public function load($command)
    {
        require $command;
    }
}
