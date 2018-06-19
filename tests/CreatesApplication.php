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
        require __DIR__.'/../bootstrap/version.php';

        $app = require __DIR__.'/../bootstrap/app.php';

        $app->singleton(Kernel::class, Blacksmith::class);

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
