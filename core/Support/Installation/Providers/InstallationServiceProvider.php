<?php

namespace Pluma\Support\Installation\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Pluma\Providers\DatabaseServiceProvider;

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
        if (! $this->checkIfAppIsProperlyInstalled()) {
            // Routes
            include_file(core_path('Support/Installation/routes'), 'install.routes.php');

            // Views
            $this->loadViewsFrom(core_path('Support/Installation/views'), "Install");
        }
    }

    public function checkIfAppIsProperlyInstalled()
    {
        try {
            // First, check if can connect to database
            DB::connection()->getPdo();

            // Then, check if .install is deleted
            if (file_exists(base_path('.install'))) {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        } catch (\InvalidArgumentException $e) {
            return false;
        }

        return true;
    }
}
