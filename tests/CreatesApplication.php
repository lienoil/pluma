<?php

namespace Tests;

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
        require __DIR__.'/../core/helpers/helpers.php';
        require __DIR__.'/../core/helpers/functions.php';

        $app = require __DIR__.'/../bootstrap/app.php';


        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
