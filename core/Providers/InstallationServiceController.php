<?php

namespace Pluma\Providers;

use Illuminate\Support\ServiceProvider;

class InstallationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        // Routes
        include_file(core_path('Support/Installation/routes'), 'install.routes.php');

        // Views
        $this->loadViewsFrom(core_path('Support/Installation/views'), "Install");
    }
}
