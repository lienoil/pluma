<?php

use Frontier\Composers\NavigationViewComposer;
use Frontier\Support\Breadcrumbs\Composers\BreadcrumbComposer;
use Frontier\Support\Sidebar\Sidebar;
use Illuminate\Support\Facades\Request;
use Pluma\Support\Facades\Route;

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
        // if (cache()->has("navigations.$key")) {
        //     return cache()->get("navigations.$key", []);
        // }

        $composer = new NavigationViewComposer();
        $composer->setCurrentUrl(Request::path());
        $composer->setCurrentRouteName(Route::currentRouteName());
        $composer->setMenus($composer->getFileFromModules('config/menus.php'));
        $composer->setBreadcrumbs($composer->getCurrentUrl());

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

if (! function_exists('sidebar')) {
    /**
     * Retrieves the sidebar menus.
     *
     * @param string $command
     * @return array
     */
    function sidebar()
    {
        return new Sidebar();
    }
}

if (! function_exists('get_sidebar')) {
    /**
     * By default, the function will get the current menu (if any) based on
     * the url.
     *
     * @param  string $name
     * @param  string $key
     * @param  array $menus
     * @return array|object|mixed
     */
    function get_sidebar($name = null, $key = 'slug', $menus = null)
    {
        $menus = $menus ?? sidebar()->all();
        $value = is_null($name) ? request()->url() : $name;

        foreach ($menus as $i => $menu) {
            if (array_key_exists($key, $menu) && $menu->{$key} === $value) {
                return json_decode(json_encode($menu));
            }

            if ($menu->has_children) {
                $item = get_sidebar($name, $key, $menu->children);
            }
        }

        return json_decode(json_encode($item ?? null));
    }
}

if (! function_exists('breadcrumbs')) {
    /**
     * Retrieves the breadcrumbs menus
     *
     * @return mixed
     */
    function breadcrumbs()
    {
        $composer = new BreadcrumbComposer();
        $composer->setCurrentUrl(Request::path());
        $composer->setCurrentRouteName(Route::currentRouteName());
        $composer->setBreadcrumbs($composer->getCurrentUrl());
        return $composer->handle();
    }
}
