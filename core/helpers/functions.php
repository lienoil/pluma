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

if (! function_exists('get_module')) {
    /**
     * Gets the pathname of the module specified
     *
     * @param  string $retrieve
     * @return mixed
     */
    function get_module($retrieve, $modules = null)
    {
        $mm = false;
        $modules = is_null($modules) ? get_modules_path() : $modules;

        foreach ($modules as $name => $module) {
            if (! is_array($module)) {
                if (basename($module) == $retrieve) {
                    return realpath($module);
                }
            } else {
                $mm = get_module($retrieve, $module);
                if (basename($mm) == $retrieve) {
                    return realpath($name);
                }
            }
        }

        return realpath($mm);
    }
}

if (! function_exists('get_modules_path')) {
    /**
     * Gets the all migrations path.
     *
     * @param  boolean $basenameOnly
     * @param  boolean $includeCoreModules
     * @param  string  $modulesPath
     * @return array
     */
    function get_modules_path($basenameOnly = false, $includeCoreModules = true, $modulesPath = null)
    {
        $modules = is_null($modulesPath) ? glob(__DIR__."/../../modules/*", GLOB_ONLYDIR) : glob("$modulesPath/*", GLOB_ONLYDIR);

        if ($includeCoreModules) {
            $coreModules = is_null($modulesPath) ? glob(__DIR__."/../../core/submodules/*", GLOB_ONLYDIR) : glob("$modulesPath/*", GLOB_ONLYDIR);
            $modules = array_merge($modules, $coreModules);
        }

        $m = [];
        foreach ($modules as $k => $module) {
            if (is_dir("$module/submodules")) {
                $m[] = $basenameOnly ? basename($module) : realpath($module);
                $mmm = get_modules_path($basenameOnly, false, "$module/submodules");
                foreach ($mmm as $mm) {
                    $m[] = $basenameOnly ? basename($mm) : realpath($mm);
                }
            } else {
                $m[] = $basenameOnly ? basename($module) : realpath($module);
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
        if (empty($modules)) $modules = modules(true, null, false);
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
        return ! file_exists(public_path('.install'));
    }
}

if (! function_exists('write_to_env')) {
    function write_to_env($data)
    {
        if (file_exists(base_path('.env'))) {
            return;
        }

        if (! count($data)) {
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

if (! function_exists('theme')) {
    /**
     * Gets theme files from specified path
     *
     * @param  string $file
     * @return Illuminate\Http\Response
     */
    function theme($file)
    {
        return url("theme/$file");
    }
}

if (! function_exists('assets')) {
    /**
     * Gets assets files from specified path
     *
     * @param  string $file
     * @return Illuminate\Http\Response
     */
    function assets($file)
    {
        return url("~assets/$file");
    }
}

if (! function_exists('present')) {
    /**
     * Gets presentations files from specified path
     *
     * @param  string $file
     * @return Illuminate\Http\Response
     */
    function present($file)
    {
        return url("~p/$file");
    }
}

if (! function_exists('user')) {
    /**
     * Shorthand for auth()->user().
     *
     * @return User\Models\User
     */
    function user()
    {
        return auth()->user();
    }
}

if (! function_exists('loop_modules')) {
    /**
     * DB Migrate function.
     *
     * @param  function $callback
     * @param  array $modules
     * @return void
     */
    function loop_modules($callback = null, $modules = null)
    {
        $modules = is_null($modules) ? modules(true, null, false) : $modules;

        foreach ($modules as $name => $module) {
            if (is_array($module)) {
                loop_modules($module, $callback);

                $module = $name;
            }

            $callback($name, $module);
        }
    }
}

if (! function_exists('get_permissions')) {
    /**
     * Gets the permissions files from modules.
     *
     * @param  array $modules
     * @return array
     */
    function get_permissions($modules = null)
    {
        $permissions = [];
        $modules = is_null($modules) ? get_modules_path() : $modules;

        foreach ($modules as $name => $module) {
            if (is_array($module)) {
                $permissions = get_permissions($module);
                $module = $name;
            }

            if (file_exists("$module/config/permissions.php")) {
                $permissions[] = "$module/config/permissions.php";
            }
        }

        return $permissions;
    }
}

if (! function_exists('get_menus')) {
    /**
     * Get all menus from modules.
     *
     * @param  array $modules
     * @return array|object|mixed
     */
    function get_menus($modules = null)
    {
        $menus = [];
        $modules = is_null($modules) ? get_modules_path() : $modules;

        foreach ($modules as $name => $module) {
            if (is_array($module)) {
                $menus = (array) get_menus($module);
                $module = $name;
            }

            if (file_exists("$module/config/menus.php")) {
                $menus[] = "$module/config/menus.php";
            }
        }

        return $menus;
    }
}

if (! function_exists('get_menu')) {
    /**
     * Get the specified menu from the menus files of every module.
     *
     * @param  string $name
     * @param  string $key
     * @return array|object|mixed
     */
    function get_menu($name, $key = 'slug')
    {
        $menus = get_menus();

        foreach ($menus as $menu) {
            $menu = require_once $menu;

            if (isset($menu[$key]) && $menu[$key] == $name) {
                return json_decode(json_encode($menu));
            }
        }

        return json_decode(json_encode([]));;
    }
}
