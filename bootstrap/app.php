<?php

/**
 *---------------------------------------------------------------------------
 * Start your Engines
 *---------------------------------------------------------------------------
 *
 */

// Create the app instance
$app = new Pluma\Application(
    realpath(__DIR__.'/../')
);

// $app->singleton('app', Pluma\Application::class);

// Register application instance with container
$app['app'] = $app;

// Set environment
$app['env'] = env('APP_ENV', 'development');

with(new Illuminate\Events\EventServiceProvider($app))->register();
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();

$app->routes();

// Instantiate the request
$request = Illuminate\Http\Request::createFromGlobals();

// Dispatch the router
$response = $app['router']->dispatch($request);

// Send the response
$response->send();


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
