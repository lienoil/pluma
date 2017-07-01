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

    /**
     * Create a new service provider instance.
     *
     * @return void
     */
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
        $this->registerModules();

        $this->registerStaticViews();
    }

    /**
     * Load views from static folder.
     *
     * @return void
     */
    protected function registerStaticViews()
    {
        if (is_dir(config("view.static", 'resources/views/static'))) {
            $this->staticBasename = config("view.static_basename", $this->staticBasename);

            $this->loadViewsFrom(config("view.static", 'resources/views/static'), $this->staticBasename);
        }
    }

    /**
     * Register the modules.
     *
     * @return void
     */
    public function registerModules()
    {
        $this->loadModules($this->modules);
    }

    /**
     * Load service providers from the specified modules.
     *
     * @return void
     */
    public function loadModules($modules = null)
    {
        foreach ($modules as $key => $module) {
            if (is_array($module)) {
                // Load Modules again
                $this->loadModules($module);

                // Swap parent module
                $module = $key;
            }

            // Load Services
            $this->loadServiceProviders($module);

            // Load Views
            $this->loadViews($module);

            // Load Routes
            $this->loadRoutes($module);
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

        if (file_exists("$module/routes/api.php")) {
            Route::group([
                'middleware' => ['api'],
                'prefix' => config('routes.api.slug', 'api')
            ], function () use ($module) {
                include_file("$module/routes", "api.php");
            });
        }

        if (file_exists("$module/routes/admin.php")) {
            Route::group([
                'middleware' => ['web'],
                'prefix' => config('routes.admin.slug', 'admin')
            ], function () use ($module) {
                include_file("$module/routes", "admin.php");
            });
        }

        if (file_exists("$module/routes/web.php")) {
            Route::group([
                'middleware' => ['web'],
                'prefix' => config('routes.web.slug', '')
            ], function () use ($module) {
                include_file("$module/routes", "web.php");
            });
        }
    }
}
