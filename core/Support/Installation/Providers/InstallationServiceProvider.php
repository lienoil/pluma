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
        if (! $this->checkIfDBCanConnect()) {
            // Routes
            include_file(core_path('Support/Installation/routes'), 'install.routes.php');

            // Views
            $this->loadViewsFrom(core_path('Support/Installation/views'), "Install");
        }
    }

    public function checkIfDBCanConnect()
    {
        try {
            DB::connection()->getPdo();
        } catch (\PDOException $e) {
            return false;
        } catch (\InvalidArgumentException $e) {
            return false;
        }

        return true;
    }
}
