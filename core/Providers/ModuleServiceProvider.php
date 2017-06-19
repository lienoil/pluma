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
        $this->modules = require __DIR__.'/../../config/modules.php';//$this->app['config']['modules.enabled'];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCoreModules();

        // $this->registerModules();
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
                // if (is_dir(__DIR__."/$key/views")) {
                //     $this->loadViewsFrom(__DIR__."/$key/views", $key);
                // }
                // $this->loadViews($module);
            } else {
                dd("TEST", modules_path($module) );
                if (is_dir(__DIR__."/$module/views")) {
                    $this->loadViewsFrom(__DIR__."/$module/views", $module);
                }
            }
        }
    }
}
