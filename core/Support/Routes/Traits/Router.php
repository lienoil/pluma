<?php

namespace Pluma\Support\Routes\Traits;

trait Router
{
    public function routes()
    {
        $this['router']->get('/', function () {
            return view("Pluma::tres");
        });
    }
}
