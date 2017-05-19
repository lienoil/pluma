<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Pluma\Application(
    realpath(__DIR__.'/../')
);

// Tell facade about the application instance
Illuminate\Support\Facades\Facade::setFacadeApplication($app);

// register application instance with container
$app['app'] = $app;

// set environment
$app['env'] = 'production';

with(new Illuminate\Events\EventServiceProvider($app))->register();
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();

require __DIR__.'/../core/Routes/routes.php';

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
