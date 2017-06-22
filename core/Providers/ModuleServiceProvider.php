<?php

namespace Pluma\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Array of modules.
     *
     * @var array
     */
    protected $modules = [];

    /**
     * The hint path of all static pages.
     *
     * @var string
     */
    protected $staticBasename = "Static";

    public function __construct($app)
    {
        parent::__construct($app);

        $this->prepareModules();
    }

    public function prepareModules()
    {
        $this->modules = modules(true, null, false);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCoreModules();

        $this->registerModules();
    }

    /**
     * Register the core modules.
     *
     * @return void
     */
    protected function registerCoreModules()
    {
        $this->loadCoreViews();

        $this->loadStaticViews();
    }

    /**
     * Load views from core.
     *
     * @var  mixed|array $modules
     * @return void
     */
    protected function loadCoreViews($modules = null)
    {
        if (is_null($modules)) {
            $lookInCore = true;
            $modules = submodules("Pluma", $lookInCore);
        }

        foreach ($modules as $module) {
            $basename = basename($module);

            if (is_array($module)) {
                if (is_dir(modules_path("$key/views"))) {
                    $this->loadViewsFrom(modules_path("$key/views"), basename($key));
                }

                $this->loadCoreViews($module);
            } else {
                if (is_dir("$module/views")) {
                    $this->loadViewsFrom("$module/views", $basename);
                }
            }
        }

        if (is_dir(core_path("views"))) {
            $this->loadViewsFrom(core_path("views"), "Pluma");
        }
    }

    /**
     * Load views from static folder.
     *
     * @return void
     */
    protected function loadStaticViews()
    {
        if (is_dir(config("view.static"))) {
            $this->loadViewsFrom(config("view.static"), $this->staticBasename);
        }
    }

    /**
     * Register the modules.
     *
     * @return void
     */
    public function registerModules()
    {
        $this->loadViews();

        $this->loadModules();
    }

    /**
     * Load views from specified modules.
     *
     * @var array $modules
     * @return void
     */
    public function loadViewsXX($modules = null)
    {
        if (is_null($modules)) {
            $modules = $this->modules;
        }

        foreach ($modules as $key => $module) {
            if (is_array($module)) {
                if (is_dir(modules_path("$key/views"))) {
                    $this->loadViewsFrom(modules_path("$key/views"), basename($key));
                }

                $this->loadViews($module);
            } else {
                if (is_dir(modules_path("$module/views"))) {
                    $this->loadViewsFrom(modules_path("$module/views"), basename($module));
                }
            }
        }
    }

    /**
     * Load service providers from the specified modules.
     *
     * @return void
     */
    public function loadModules($modules = null)
    {
        if (is_null($modules)) {
            $modules = $this->modules;
        }

        foreach ($modules as $module) {
            if (is_array($module)) {
                $this->loadModules($module);
            } else {
                // Load Service
                $this->loadServiceProviders($module);

                // Load Views
                $this->loadViews($module);

                // Load Routes
                $this->loadRoutes($module);
            }
        }
    }

    public function loadServiceProviders($module = null)
    {
        $basename = basename($module);
        if (file_exists("$module/Providers/{$basename}ServiceProvider.php")) {
            $serviceProvider = "$basename\\Providers\\{$basename}ServiceProvider";
            $this->app->register($serviceProvider);
        }
    }

    /**
     * Load views from specified modules.
     *
     * @var array $modules
     * @return void
     */
    public function loadViews($module = null)
    {
        $basename = basename($module);
        if (is_dir("$module/views")) {
            $this->loadViewsFrom("$module/views", $basename);
        }
    }

    /**
     * Load routes.
     *
     * @param  array $module
     * @return void
     */
    public function loadRoutes($module = null)
    {
        $basename = basename($module);

        if (file_exists("$module/routes/admin.php")) {
            Route::group([
                'prefix' => config('admin.slug', 'admin')
            ], function () use ($module) {
                include_file("$module/routes", "admin.php");
            });
        }

        if (file_exists("$module/routes/api.php")) {
            Route::group([
                'prefix' => config('api.slug', 'api')
            ], function () use ($module) {
                include_file("$module/routes", "api.php");
            });
        }
    }
}
