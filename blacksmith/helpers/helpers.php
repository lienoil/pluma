<?php

if (! function_exists('blacksmith_path')) {
    /**
     * The Blacksmith base path.
     *
     * @param  string $path
     * @return string
     */
    function blacksmith_path($path = "")
    {
        return realpath(__DIR__."/../$path");
    }
}

if (! function_exists('blacksmith_templates_path')) {
    /**
     * The Blacksmith template path.
     *
     * @param  string $path
     * @return string
     */
    function blacksmith_templates_path($path = "")
    {
        return blacksmith_path("templates/$path");
    }
}
