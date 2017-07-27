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

        $this->setActiveTheme(config("settings.active_theme", "default"));
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
        $basename = $this->basename;
        $activeTheme = basename($this->activeTheme);
        $themePath = config('path.themes', 'themes');

        if (is_dir(base_path("$themePath/$activeTheme/views"))) {
            $this->loadViewsFrom(base_path("$themePath/$activeTheme/views"), $basename);
        } else {
            $theme = get_module("Frontier");
            $this->loadViewsFrom("$theme/views/themes/default", $basename);
        }
    }
}
