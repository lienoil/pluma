<?php

namespace Pluma\Support\Installation\Traits;

trait Installation
{
    public $installHintPath = "Installation";

    public function loadInstallationModule()
    {
        $this->loadInstallViews();
        $this->loadInstallRoutes();
    }

    public function loadInstallViews()
    {
        $this->loadViewsFrom( __DIR__ . "/../views", $this->installHintPath);
    }

    public function loadInstallRoutes()
    {
        include_file(__DIR__.'/../routes', 'install.routes.php');
    }
}
