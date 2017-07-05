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
        if (! function_exists('config')) {
            $modulePath = json_decode(json_encode(require __DIR__.'/../../config/path.php'));
            $modulePath = $modulePath->modules;
        } else {
            $modulePath = config('path.modules') ? config('path.modules') : base_path("modules");
        }

        return app()->basePath().DIRECTORY_SEPARATOR.$modulePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('migrations_path')) {
    /**
     * Gets an array of migrations_path for a given module.
     *
     * @param  string  $moduleName The module
     * @return array
     */
    function migrations_path($moduleName = "Pluma")
    {
        $modules = array_merge(app('config')->get('modules.enabled'), submodules("Pluma", true, true));
        // $modu

        return ;
    }
}

if (! function_exists('submodules')) {
    /**
     * Gets an array of submodules for a given module.
     *
     * @param  string  $moduleName The module
     * @param  boolean $lookInCore If we are looking inside the core folder
     * @param  boolean $basenameOnly omits the realpath.
     * @return array
     */
    function submodules($moduleName = "Pluma", $lookInCore = false)
    {
        $submodulePath = $lookInCore ? core_path("submodules") : base_path("modules/$moduleName/submodules");
        $submodules = file_exists($submodulePath) ? glob("$submodulePath/*", GLOB_ONLYDIR) : [];

        return $submodules;
    }
}

if (! function_exists('modules')) {
    /**
     * Gets an array of recursive modules for a given module.
     * This is the code equivalent of manually writing to config/modules.php
     *
     * @param  boolean $includeCoreModules includes the core modules and submodules.
     * @param  string  $modulesPath The module
     * @return array
     */
    function modules($includeCoreModules = false, $modulesPath = null, $basenameOnly = true)
    {
        $modules = is_null($modulesPath) ? glob(modules_path()."/*", GLOB_ONLYDIR) : glob("$modulesPath/*", GLOB_ONLYDIR);

        if ($includeCoreModules) {
            $coreModules = is_null($modulesPath) ? glob(core_path()."/submodules/*", GLOB_ONLYDIR) : glob("$modulesPath/*", GLOB_ONLYDIR);
            $modules = array_merge($modules, $coreModules);
        }

        $m = [];
        foreach ($modules as $k => $module) {
            if (! in_array(basename($module), config('modules.disabled'))) {
                if (is_dir("$module/submodules")) {
                    $m[($basenameOnly ? basename($module) : $module)] = modules(false, "$module/submodules", $basenameOnly);
                } else {
                    $m[$k] = ($basenameOnly ? basename($module) : $module);
                }
            }
        }

        return $m;
    }
}

if (! function_exists('get_migrations')) {
    /**
     * Gets the all migrations path.
     *
     * @param  array  $modules
     * @param  string $path
     * @return array
     */
    function get_migrations($modules = [], $path = "")
    {
        if (empty($modules)) $modules = modules();
        $migrationsPath = [];

        foreach ($modules as $key => $module) {
            if (is_array($module)) {
                if (is_dir("$key/$path")) {
                    $migrationsPath["$key/$path"] = get_migrations($module, $path);
                }
            } else {
                if (is_dir("$module/$path")) {
                    $migrationsPath[] = "$module/$path";
                }
            }
        }

        return $migrationsPath;
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
        return require "$path/$file";
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
        return ! file_exists(base_path('.install'));
    }
}

if (! function_exists('write_to_env')) {
    function write_to_env($data)
    {
        if (!count($data)) {
            return;
        }

        $pattern = '/([^\=]*)\=[^\n]*/';

        $envFile = base_path('.env');

        $lines = file($envFile);
        $newLines = [];
        foreach ($lines as $line) {
            preg_match($pattern, $line, $matches);

            if (! count($matches)) {
                $newLines[] = $line;
                continue;
            }

            if (! key_exists(trim($matches[1]), $data)) {
                $newLines[] = $line;
                continue;
            }

            if (strpos(trim($matches[1]), ' ') !== false) {
                $line = trim($matches[1]) . "={$data[trim($matches[1])]}\n";
            } else {
                $line = trim($matches[1]) . "=\"{$data[trim($matches[1])]}\"\n";
            }
            $newLines[] = $line;
        }

        $newContent = implode('', $newLines);
        file_put_contents($envFile, $newContent);

        return true;
    }
}

if (! function_exists('generate_random_key')) {
    /**
     * Generate random key.
     *
     * @return string
     */
    function generate_random_key()
    {
        return 'base64:'.base64_encode(random_bytes(
            config('encryption.cipher') == 'AES-128-CBC' ? 16 : 32
        ));
    }
}
