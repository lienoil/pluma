<?php

namespace Pluma\Support\Modules\Traits;

trait ModulerTrait
{
    /**
     * The modules array
     *
     * @var Array
     */
    public $modules;

    /**
     * Alias for getModules method.
     *
     * @return array
     */
    public function modules()
    {
        return empty($this->getModules())
            ? $this->getModulesFromFiles()
            : $this->getModules();
    }

    /**
     * Retrieves the realpath of the array of modules.
     *
     * @return array
     */
    public function modulePaths()
    {
        return $this->getModulesFromFiles(false);
    }

    /**
     * Retrieves the modules array.
     *
     * @return array
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Sets the modules array.
     *
     * @param array $modules
     * @return $this
     */
    public function setModules(Array $modules = null)
    {
        $this->modules = $modules;

        return $this;
    }

    /**
     * Retrieves the modules present in core and modules folder
     * if not found in cache.
     *
     * @param  Boolean $isBasenameOnly
     * @return array
     */
    public function getModulesFromFiles($isBasenameOnly = true)
    {
        return cache()->get('modules', get_modules_path($isBasenameOnly));
    }

    /**
     * Gets the full path of the specified module.
     *
     * @param  Array $module
     * @param  String $default
     * @return string
     */
    public function getModulePath($module, $default = '')
    {
        foreach ($this->getModulesFromFiles(false) as $modulePath) {
            if ($module === basename($modulePath)) {
                return $modulePath;
            }
        }

        return $default;
    }
}
