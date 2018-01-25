<?php

if (! function_exists('navigations')) {
    /**
     * Gets all the navigations.
     *
     * param  string $key
     * @return mixed
     */
    function navigations($key = null)
    {
        return config("app.navigations")->{$key} ?? config("app.navigations") ?? null;
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
