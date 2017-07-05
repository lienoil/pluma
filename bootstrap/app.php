<?php

/**
 *---------------------------------------------------------------------------
 * Start your Engines
 *---------------------------------------------------------------------------
 *
 */

// Create the app instance
$app = new Pluma\Application\Application(
    __DIR__.'/../'
);

$app->singleton(
    \Illuminate\Contracts\Http\Kernel::class,
    \Pluma\Http\Kernel::class
);

$app->singleton(
    \Illuminate\Contracts\Console\Kernel::class,
    \Pluma\Console\Kernel::class
);

$app->singleton(
    \Illuminate\Contracts\Debug\ExceptionHandler::class,
    \Pluma\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
