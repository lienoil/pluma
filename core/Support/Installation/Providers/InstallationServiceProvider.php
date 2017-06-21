<?php

namespace Pluma\Support\Installation\Providers;

use Illuminate\Support\ServiceProvider;

class InstallationServiceProvider extends ServiceProvider
{

    /**
     * Boot the service.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        if (file_exists(base_path('.install'))) {
            // Routes
            include_file(core_path('Support/Installation/routes'), 'install.routes.php');

            // Views
            $this->loadViewsFrom(core_path('Support/Installation/views'), "Install");
        }
    }
}
