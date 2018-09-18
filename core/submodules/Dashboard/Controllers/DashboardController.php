<?php

namespace Dashboard\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;

class DashboardController extends AdminController
{
    /**
     * Show list of resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pages = \User\Models\User::cached();

        $logger = new \Monolog\Logger('general');
        $logger->pushProcessor(new \Monolog\Processor\WebProcessor);
        $browserHandler = new \Monolog\Handler\BrowserConsoleHandler(\Monolog\Logger::INFO);
        $logger->pushHandler($browserHandler);
        $logger->info('Info message');

        return view("Dashboard::admin.index");
    }
}
