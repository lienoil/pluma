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
    Illuminate\Contracts\Http\Kernel::class,
    Pluma\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Pluma\Exceptions\Handler::class
);

// Handle Events
// with(new Illuminate\Events\EventServiceProvider($app))->register();

// Handle Routing
// with(new Illuminate\Routing\RoutingServiceProvider($app))->register();

// Include the main route
// require_once core_path('routes/routes.php');

// Instantiate the request
// $request = \Illuminate\Http\Request::createFromGlobals();

// // Dispatch the router
// $response = $app['router']->dispatch($request);

// Send the response
// $response->send();


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
