<?php

namespace Pluma\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        echo "<pre>";
            var_dump( "yes" ); die();
        echo "</pre>";
    }
}