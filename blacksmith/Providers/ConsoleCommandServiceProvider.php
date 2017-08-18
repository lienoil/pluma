<?php

namespace Blacksmith\Providers;

use Blacksmith\Console\Kernel;
use Blacksmith\Support\Providers\ServiceProvider;

class ConsoleCommandServiceProvider extends ServiceProvider
{
    /**
     * Instance of the \Blacksmith\Console\Kernel
     *
     * @var \Blacksmith\Console\Kernel
     */
    protected $console;

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->console = new Kernel();
        $this->commands($this->console->commands);
    }
}
