<?php

if (! function_exists('core_path')) {
    function core_path($path = '')
    {
        $corePath = "core"; // config("settings.core.path", 'core/');
        return app()->basePath().DIRECTORY_SEPARATOR.$corePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('modules_path')) {
    /**
     * Gets the path of modules.
     *
     * @param  string  $path
     * @return array
     */
    function modules_path($path = '')
    {
        $modulePath = config('path.modules') ? config('path.modules') : base_path("modules");
        return app()->basePath().DIRECTORY_SEPARATOR.$modulePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('submodules')) {
    /**
     * Gets an array of submodules for a given module.
     *
     * @param  string  $moduleName The module
     * @param  boolean $lookInCore If we are looking inside the core folder
     * @return array
     */
    function submodules($moduleName = "Pluma", $lookInCore = false)
    {
        $submodulePath = $lookInCore ? core_path("submodules") : base_path("modules/$moduleName/submodules");
        $submodules = file_exists($submodulePath) ? glob("$submodulePath/*", GLOB_ONLYDIR) : [];

        return $submodules;
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

if (! function_exists("include_files")) {
    /**
     * Include the file specified foreach item
     * in array.
     *
     * @param  array $filePaths Array of file paths
     * @param  string $file      File to include
     * @return void
     */
    function include_files($filePaths, $file = "")
    {
        foreach ($filePaths as $filePath) {
            if (file_exists("$filePath/$file")) {
                include_once "$filePath/$file";
            }
        }
    }
}

if (! function_exists("include_file")) {
    /**
     * Include the file specified
     *
     * @param  string $filePaths file path
     * @param  string $file      File to include
     * @return void
     */
    function include_file($filePath, $file = "")
    {
        if (file_exists("$filePath/$file")) {
            include_once "$filePath/$file";
        }
    }
}

if (! function_exists('require_config')) {
    function require_config($file, $path = __DIR__.'/../config')
    {
        return require $path . '/' . $file;
    }
}

if (! function_exists("settings")) {
    function settings($key = null, $default = null)
    {
        return config("settings.$key", $default);
    }
}

if (! function_exists('is_installed')) {
    function is_installed()
    {
        return file_exists(base_path('.installed')) && ! file_exists(base_path('.install'));
    }
}
