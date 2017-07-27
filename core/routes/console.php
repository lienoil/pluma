<?php

use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment('lololo');
})->describe('Display an inspiring quote');

Artisan::command('route:list', function () {
    $routeCollection = app('router')->getRoutes();

        echo "+-----------------------------------------+------+\n";
        echo "| URL                                     |      |\n";
        echo "+-----------------------------------------+------+\n";
    foreach ($routeCollection as $value) {
        $uri = $value->uri() . str_repeat(" ", (40-strlen($value->uri())));
        $name = $value->getName();
        echo "| $uri| $name  |\n";
    }
});
