<?php

use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Helper\Table;
use \Symfony\Component\Process\Exception\ProcessFailedException;
use \Symfony\Component\Process\Process;

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
    $headers = ['Methods', 'URI', 'Name', 'Module'];
    $data = [];

    foreach ($routeCollection as $value) {
        $data[] = [
            'methods' => implode("/", $value->methods()),
            'uri' => $value->uri(),
            'name' => $value->getName(),
            'module' => guess_module($value->getName())
        ];
    }

    $data = collect($data)->toArray();

    $this->table($headers, (array) $data);
});
