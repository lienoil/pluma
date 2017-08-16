<?php

namespace Blacksmith\Console;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Kernel
{
    /**
     * Array of registered commands.
     *
     * @var array
     */
    protected $commands = [
        Commands\Furnace\ForgeWeaponCommand::class,
        Commands\Migrations\MigrateCommand::class,
    ];

    /**
     * Instance of the \Symfony\Component\Console\Application.
     *
     * @var \Symfony\Component\Console\Application
     */
    protected $console;
    protected $root;
    protected $pattern = "/^.*Console\\/Commands\\/.*\.php$/";

    /**
     * Construct
     *
     * @return void
     */
    public function __construct(Application $console, $app, $directory)
    {
        $this->console = $console;
        $this->app = $app;
        $this->root = $directory;
    }

    /**
     * Adds a command.
     *
     * @param mixed $registree
     */
    public function add($registree)
    {
        $this->console->add(new $registree);
    }

    /**
     * Runs the class.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->commands() as $command) {
            $this->add(new $command);
        }
    }

    /**
     * Gets commands from registered commands paths.
     *
     */
    public function commands()
    {
        return $this->commands;
    }
}
