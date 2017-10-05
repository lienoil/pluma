<?php

namespace Blacksmith\Console;

use Pluma\Console\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    /**
     * Array of registered commands.
     *
     * @var array
     */
    public $commands = [
        // Blacksmith
        Commands\DB\DBEmptyCommand::class,
        Commands\DB\DBDropCommand::class,
        Commands\Furnace\ForgeControllerCommand::class,
        Commands\Furnace\ForgeModelCommand::class,
        Commands\Furnace\ForgeModuleCommand::class,
        Commands\Furnace\ForgeObserverCommand::class,
        Commands\Furnace\ForgePermissionsCommand::class,
        Commands\Furnace\ForgeWeaponCommand::class,
        Commands\Furnace\PurgeCacheCommand::class,
        Commands\Furnace\PurgeStorageCommand::class,
        Commands\Phinx\PhinxMigrateCreateCommand::class,
        Commands\Phinx\PhinxMigrateRunCommand::class,
        Commands\Phinx\PhinxSeedCreateCommand::class,
        Commands\Phinx\PhinxSeedRunCommand::class,

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
}
