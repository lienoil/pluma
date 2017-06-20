<?php

namespace Pluma\Providers;

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
        $this->modules = config('modules');
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
     * @return void
     */
    protected function loadCoreViews()
    {
        $lookInCore = true;
        $submodules = submodules("Pluma", $lookInCore);

        foreach ($submodules as $submodule) {
            $basename = basename($submodule);

            if (is_dir("$submodule/views")) {
                $this->loadViewsFrom("$submodule/views", $basename);
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

        $this->loadServiceProviders();
    }

    /**
     * Load views from specified modules.
     *
     * @var array $modules
     * @return void
     */
    public function loadViews($modules = null)
    {
        if (is_null($modules)) {
            $modules = $this->modules['enabled'];
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
    public function loadServiceProviders()
    {
        // TODO: DELET THIS TEST
        view()->composer(['*'], \Frontier\Composers\PageViewComposer::class);
    }
}
