<?php

namespace Pluma\Console;

use Pluma\Console\Commands\Scheduling\Schedule;
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
        $this->scheduledJobs($schedule);
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(core_path('routes/console.php'));

        $this->loadCommandsFromCore();

        $this->loadCommandsFromModules();

        $this->loadCommandRoutesFromModules();
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

    /**
     * Get all console commands from modules.
     *
     * @return void
     */
    protected function loadCommandsFromModules()
    {
        foreach (get_modules_path() as $module) {
            if (file_exists("$module/config/console.php")) {
                $commands = (array) require "$module/config/console.php";
                $this->commands = array_merge($this->commands, $commands);
            }
        }
    }

    /**
     * Get all console route commands from modules.
     *
     * @return void
     */
    protected function loadCommandRoutesFromModules()
    {
        foreach (get_modules_path() as $module) {
            if (file_exists("$module/routes/console.php")) {
                $this->load("$module/routes/console.php");
            }
        }
    }

    /**
     * Get all console commands from core.
     *
     * @return void
     */
    protected function loadCommandsFromCore()
    {
        if (file_exists(core_path('config/console.php'))) {
            $commands = require_once core_path('config/console.php');
            $this->commands = array_merge($this->commands, $commands);
        }
    }

    /**
     * Loads the scheduled commands from modules.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function scheduledJobs(Schedule $schedule)
    {
        foreach (get_modules_path() as $module) {
            if (file_exists("$module/config/jobs.php")) {
                $jobs = require_once "$module/config/jobs.php";
                foreach ($jobs as $class) {
                    $schedule->job(new $class['job'], $class['queue']);
                }
            }
        }
    }
}
