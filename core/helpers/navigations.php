<?php

use Frontier\Composers\NavigationViewComposer;

if (! function_exists('navigations')) {
    /**
     * Gets all the navigations.
     *
     * @param  string   $key
     * @param  boolean  $collected
     * @return mixed
     */
    function navigations($key = null, $collected = true)
    {
        $composer = new NavigationViewComposer();
        $composer->setMenus(
            $composer->requireFileFromModules(
                'config/menus.php',
                modules(true, null, false)
            )
        );

        $composer = $collected
            ? ($composer->handle()->{$key}->collect ?? $composer->handle()->{$key})
            : $composer->handle()->{$key};

        return $composer;
    }
}

if (! function_exists('navigation')) {
    /**
     * Gets the current navigation based on route.
     *
     * @param  string $key
     * @return mixed
     */
    function navigation($key = "sidebar.current")
    {
        return config("app.navigations.{$key}");
    }
}
