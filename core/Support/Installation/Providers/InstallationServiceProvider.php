<?php

namespace Pluma\Support\Installation\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Pluma\Providers\DatabaseServiceProvider;
use Pluma\Support\Installation\Traits\AppIsInstalled;

class InstallationServiceProvider extends ServiceProvider
{
    use AppIsInstalled;

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
        if (! $this->appIsInstalled()) {
            // Routes
            Route::group([
                'middleware' => ['web'],
            ], function () {
                include_file(core_path('routes'), 'fuzzy.php');
                include_file(core_path('Support/Installation/routes'), 'install.routes.php');
            });

            // Views
            $this->loadViewsFrom(core_path('Support/Installation/views'), "Install");
        }
    }
}
