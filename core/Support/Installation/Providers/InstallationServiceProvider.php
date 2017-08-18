<?php

namespace Pluma\Support\Installation\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Pluma\Providers\DatabaseServiceProvider;
use Pluma\Support\Installation\Traits\IsInstalledCheck;

class InstallationServiceProvider extends ServiceProvider
{
    use IsInstalledCheck;

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
        if (! $this->checkIfAppIsProperlyInstalled()) {
            // Routes
            Route::group([
                //
            ], function () {
                include_file(core_path('routes'), 'fuzzy.php');
                include_file(core_path('Support/Installation/routes'), 'install.routes.php');
            });

            // Views
            $this->loadViewsFrom(core_path('Support/Installation/views'), "Install");
        } else {
            $modules = get_modules_path();
            foreach ($modules as $module) {
                if (file_exists("$module/routes/public.php")) {
                    Route::group([
                        'middleware' => ['web'],
                    ], function () use ($module) {
                        include_file("$module/routes", "public.php");
                    });
                }
            }
        }
    }
}
