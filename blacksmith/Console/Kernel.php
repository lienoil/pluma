<?php

namespace Blacksmith\Console;

use Pluma\Console\Commands\Scheduling\Schedule;
use Pluma\Console\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    /**
     * Array of registered commands.
     *
     * @var array
     */
    public $commands = [
        // App
        Commands\App\AppGrantsRefreshCommand::class,
        Commands\App\AppHomepageCommand::class,
        Commands\App\AppPermissionsRefreshCommand::class,
        Commands\App\AppRolesGenerateCommand::class,
        Commands\App\AppVersionCommand::class,

        // Key
        Commands\Key\KeyGenerateCommand::class,

        // Blacksmith
        Commands\DB\DBDropCommand::class,
        Commands\DB\DBEmptyCommand::class,
        Commands\DB\DBMigrateCommand::class,
        Commands\DB\DBSeedCommand::class,
        Commands\Furnace\ForgeAccountCommand::class,
        Commands\Furnace\ForgeControllerCommand::class,
        Commands\Furnace\ForgeModelCommand::class,
        Commands\Furnace\ForgeModuleCommand::class,
        Commands\Furnace\ForgeObserverCommand::class,
        Commands\Furnace\ForgePermissionsCommand::class,
        Commands\Furnace\ForgeWeaponCommand::class,
        Commands\Furnace\PurgeCacheCommand::class,
        Commands\Furnace\PurgeModuleCommand::class,
        Commands\Furnace\PurgeSessionsCommand::class,
        Commands\Furnace\PurgeStorageCommand::class,
        Commands\Furnace\PurgeViewsCommand::class,
        Commands\Phinx\PhinxMigrateCreateCommand::class,
        Commands\Phinx\PhinxMigrateRunCommand::class,
        Commands\Phinx\PhinxSeedCreateCommand::class,
        Commands\Phinx\PhinxSeedRunCommand::class,

        // Misc
        Commands\Misc\FurnaceCommand::class,

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
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(base_path('blacksmith/routes/console.php'));

        parent::commands();
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        parent::schedule($schedule);
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
