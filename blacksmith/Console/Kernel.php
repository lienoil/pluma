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
        Commands\Furnace\ForgeWeaponCommand::class,
        Commands\Furnace\ForgeModuleCommand::class,
        Commands\Phinx\PhinxMigrateCommand::class,
        Commands\Phinx\PhinxCreateCommand::class,

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
