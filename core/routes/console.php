<?php

use Illuminate\Support\Facades\Artisan;
use \Symfony\Component\Process\Process;
use \Symfony\Component\Process\Exception\ProcessFailedException;

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

Artisan::command('migrate', function () {

    loop_modules(function ($name, $module) {
        $migrationsPath = $module."/".config('path.migrations', 'database/migrations');

        $process = new Process("php ./vendor/bin/phinx migrate -c config/migrations.php");
        $process->run();

        echo $process->getOutput();
    }, modules(true, null, false));

});
