<?php

namespace Pluma;

use Illuminate\Container\Container;
use Pluma\Provider\PlumaServiceProvider;

class Application extends Container
{
    protected $realPath;
    protected $corePath;

    public function __construct($realPath = './')
    {
        $this->setRealPath($realPath);
        $this->setCorePath($realPath.'/core');
    }

    public function start()
    {
        $this->includeHelperFunctions();
        $this->services();
        $this->load();
    }

    public function load()
    {
        $directories = [
            $this->getCorePath().'Controllers',
            $this->getCorePath().'Models',
        ];

        // register the autoloader and add directories
        ClassLoader::register();
        ClassLoader::addDirectories($directories);
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
        include_once $this->getRealPath().'/core/helpers/functions.php';
    }
}
