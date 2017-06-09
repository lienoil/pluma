<?php

namespace Pluma\Support\Routes\Traits;

use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

trait Routing
{
    protected $request;
    protected $events;
    protected $router;

    public function routes()
    {
        $this->bindRouter();
        $this->createDispatcher();
        $this->createRouterInstance();
        $this->loadRoutes();
        // $this['router']->get('/', function () {
        //     return view("Pluma::tres");
        // });
    }

    public function bindRouter()
    {
        $this->request = Request::capture();
        $this->app->instance(\Illuminate\Http\Request::class, $this->request);
    }

    public function loadRoutes()
    {
        if (file_exists(core_path("routes/routes.php"))) {
            include_once core_path("routes/routes.php");
        }
    }

    public function createDispatcher()
    {
        $this->events = new Dispatcher($this->app);
    }

    public function createRouterInstance()
    {
        $this->router = new Router($this->events, $this->app);
    }
}
