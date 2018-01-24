<?php

use Crowfeather\Traverser\Traverser;
use Frontier\Composers\NavigationViewComposer;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Engines\Engine;
use Illuminate\View\View;

if (! function_exists('menus')) {
    /**
     * Gets all the menus.
     *
     * @param  mixed $menus
     * @return mixed
     */
    function menus($menus)
    {
        return collect($menus);
    }
}

if (! function_exists('menu')) {
    /**
     * Gets the current menu based on route.
     *
     * @param  mixed $menus
     * @return mixed
     */
    function menu($menus = [])
    {
        foreach (menus($menus) as $name => $menu) {
            if (isset($menu->slug) && $menu->slug === URL::current()) {
                return $menu;
            }
        }

        return false;
    }
}
