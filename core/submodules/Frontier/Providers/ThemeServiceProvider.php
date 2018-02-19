<?php

namespace Frontier\Providers;

use Illuminate\Support\Facades\Route;
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

        $this->setActiveTheme(settings('active_theme', 'default'));
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

        $this->registerRoutes();
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

        // Load views from themes, available in hint path
        // Theme::*, e.g. view("Theme::partials.header")
        if (is_dir(base_path("$themePath/$activeTheme/views"))) {
            // Load generic hint path, Theme
            $this->loadViewsFrom(base_path("$themePath/$activeTheme/views"), $this->basename);
        }

        // Load all themes in their own hint path
        foreach (get_themes() as $theme) {
            // Load hint path same as theme's name
            if (is_dir($theme->path)) {
                $this->loadViewsFrom("{$theme->path}/views", ucfirst($theme->hintpath));
            }
        }

        // Default is loaded after the themes.
        $this->registerDefaultViews();
    }

    /**
     * Registers the default views from modules.
     *
     * @param  array $modules
     * @return void
     */
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

    /**
     * Registers the theme routes.
     *
     * @return void
     */
    public function registerRoutes()
    {
        $activeTheme = @settings('active_theme', 'default');

        if (file_exists(themes_path("$activeTheme/routes/web.php"))) {
            Route::group([
                'middleware' => ['web'],
                'prefix' => config('routes.web.slug', ''),
            ], function () use ($activeTheme) {
                include_file(themes_path("$activeTheme/routes"), "web.php");
            });
        }
    }
}
