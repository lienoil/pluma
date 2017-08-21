<?php

namespace Frontier\Providers;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Basename for the modules.
     *
     * @var string
     */
    protected $basename = 'Theme';

    /**
     * The active theme name.
     *
     * @var string
     */
    protected $activeTheme;

    /**
     * The array of view composers.
     *
     * @var array
     */
    protected $composers;

    /**
     * The app's router instance.
     *
     * @var Illuminate\Routing\Router
     */
    protected $router;

    /**
     * Create a new service provider instance.
     *
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct($app);

        $this->setActiveTheme(settings('active_theme', "default"));
    }

    /**
     * Sets the active Theme.
     *
     * @param string $theme
     */
    public function setActiveTheme($activeTheme)
    {
        $this->activeTheme = $activeTheme;
    }

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
        $this->registerViews();
    }

    /**
     * Load views from specified modules.
     *
     * @var string $module
     * @return void
     */
    public function registerViews()
    {
        $activeTheme = basename($this->activeTheme);
        $themePath = config('path.themes', 'themes');

        if (is_dir(base_path("$themePath/$activeTheme/views"))) {
            $this->loadViewsFrom(base_path("$themePath/$activeTheme/views"), $this->basename);
        }

        // Default is loaded after the themes.
        $this->registerDefaultViews();
    }

    public function registerDefaultViews($modules = null)
    {
        $modules = $modules ? $modules : modules(true, null, false);
        foreach ($modules as $name => $module) {
            if (is_array($module)) {
                $this->registerDefaultViews($module);
                $module = $name;
            }
            $this->loadViewsFrom("$module/views", $this->basename);
        }
    }
}
