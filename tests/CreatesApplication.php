<?php

namespace Tests;

use Blacksmith\Console\Kernel as Blacksmith;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Pluma\Application\Application
     */
    public function createApplication()
    {
        require_once __DIR__.'/../bootstrap/version.php';
        require_once __DIR__.'/../core/helpers/helpers.php';
        require_once __DIR__.'/../core/helpers/functions.php';
        require_once __DIR__.'/../console/blacksmith/helpers/helpers.php';

        $app = require __DIR__.'/../bootstrap/app.php';

        $app->singleton(
            Kernel::class,
            Blacksmith::class
        );

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
