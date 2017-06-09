<?php

use Illuminate\Support\Facades\File;

if (! function_exists('core_path')) {
    function core_path($path = '')
    {
        $corePath = "core/"; // config("settings.core.path", 'core/');
        return app()->basePath().$corePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('submodules')) {
    /**
     * Gets an array of Submodules for a given module.
     *
     * @param  string  $moduleName The module
     * @param  boolean $lookInCore If we are looking inside the core folder
     * @return array
     */
    function submodules($moduleName = "Pluma", $lookInCore = false)
    {
        $submodulePath = $lookInCore ? core_path("Submodules") : base_path("modules/$moduleName/Submodules");
        $submodules = File::exists($submodulePath) ? File::directories($submodulePath) : '';
        dd($submodules);
        return app()->basePath().$corePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        return $value;
    }
}