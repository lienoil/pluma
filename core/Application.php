<?php

namespace Pluma;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Pluma\Provider\PlumaServiceProvider;
use Pluma\Support\Database\Traits\Database;
use Pluma\Support\Env\Traits\Env;
use Pluma\Support\Facades\AliasLoader;
use Pluma\Support\Handlers\ExceptionHandler;
use Pluma\Support\Routes\Traits\Router;

class Application extends Container
{
    use Env, ExceptionHandler, Router, Database;

    protected $realPath;
    protected $basePath;
    protected $corePath;

    public function __construct($realPath = './')
    {
        $this->includeHelperFunctions();
        $this->registerBaseBindings();
        $this->registerClassAliases();
        // $this->registerExceptionHandlers();
        $this->setRealPath($realPath);
        $this->setCorePath($realPath.'/core');
        // $this->loadEnv();
    }

    public function start()
    {
        $this->services();
        $this->load();
    }

    /**
     * Register Exception handlers
     *
     * @return void
     */
    public function registerExceptionHandlers()
    {
        $this->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \Pluma\Exceptions\Handler::class
        );
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        static::setInstance($this);

        $this->instance('app', $this);

        // Tell facade about the application instance
        Facade::setFacadeApplication($this);

        $this->instance(Illuminate\Container\Container::class, $this);
    }

    /**
     * Register class Aliases
     *
     * @return void
     */
    public function registerClassAliases()
    {
        $aliases = require __DIR__.'/../config/aliases.php';
        AliasLoader::getInstance($aliases)->register();
    }

    public function setRealPath($realPath) {
        $this->realPath = str_finish($realPath, '/');
    }

    public function getRealPath() {
        return $this->realPath;
    }

    public function setCorePath($corePath)
    {
        $this->corePath = str_finish($corePath, '/');
    }

    public function getCorePath()
    {
        return $this->corePath;
    }

    private function services()
    {
        $provider = new PlumaServiceProvider($this);
        $provider->boot();
    }

    private function includeHelperFunctions()
    {
        include_once __DIR__.'/helpers/functions.php';
    }
}
