<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Pluma\Support\Modules\Traits\ModulerTrait;

class ForgeModuleCommand extends Command
{
    use ModulerTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:module
                           {name : The name of the module}
                           {--m|module= : The module the submodule belongs to}
                           {--l|level= : Specify the module level. Possible values: c = core, m = module, s = submodule }
                           {--standalone : Specify the module should be top level}
                           {--empty : Generate folders only}
                           ';

    /**
     * The Composer instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * The module the generated file belongs to.
     *
     * @var string
     */
    protected $module;

    /**
     * Array of module levels.
     *
     * @var array
     */
    protected $moduleLevels = [
        'core' => 'Save in core folder (usually not recommended if upgrading)',
        'module' => 'Save in the modules folder',
        'submodule' => 'Save as a submodule of another module'
    ];

    /**
     * The selected module level.
     *
     * @var string
     */
    protected $level;

    /**
     * The path the folders and files will be created.
     *
     * @var string
     */
    protected $path;

    /**
     * The filesystem instance.
     *
     * @var Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Support\Composer  $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files = $files;

        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->qualifyModuleLevel();

        $this->qualifyModule();

        $this->qualifyPath();

        $this->generateFolders();

        $this->generateFiles();

        $this->composer->dumpAutoloads();
    }

    /**
     * Get the level of the module.
     *
     * @return void
     */
    protected function qualifyModuleLevel()
    {
        if ($this->option('module')) {
            return;
        }

        switch ($this->option('level')) {
            case 'c':
            case 'core':
                $this->level = 'core';
                break;

            case 'm':
            case 'module':
                $this->level = 'module';
                break;

            case 's':
            case 'submodule':
                $this->level = 'submodule';
                break;

            default:
                $name = $this->argument('name');
                $this->level = $this->choice("What type of module is $name?", $this->moduleLevels);
                break;
        }
    }

    /**
     * Get the module the file belongs to.
     *
     * @return void
     */
    protected function qualifyModule()
    {
        $this->module = $this->option('module') ?? $this->argument('name');

        if ($this->isSubmoduleLevel() || $this->option('module')) {
            $module = $this->option('module');

            if (! $this->isModule($module)) {
                $this->error("Module [$module] not found!");
                $module = $this->choice('Specify the module the submodule will belong to.', $this->modules());
            }

            $this->module = $this->getModulePath($module);
            $this->level = 'submodule';
        }

        $this->input->setOption('module', $this->module);
    }

    /**
     * Get the path of the module.
     *
     * @return void
     */
    protected function qualifyPath()
    {
        switch ($this->level) {
            case 'core':
                $path = core_path('submodules');
                break;

            case 'submodule':
                $path = $this->module.DIRECTORY_SEPARATOR.'submodules';
                break;

            case 'module':
            default:
                $path = modules_path();
                break;
        }

        $this->path = $path.DIRECTORY_SEPARATOR.$this->argument('name');

        $this->info("Using path: {$this->path}");
    }

    /**
     * Check if level is equal to submodule.
     *
     * @return boolean
     */
    protected function isSubmoduleLevel(): bool
    {
        return $this->level === 'submodule';
    }

    /**
     * Create module folder.
     *
     * @return void
     */
    protected function generateFolders()
    {
        $module = $this->path;

        $directories = [
            "$module/Composers",
            "$module/config",
            "$module/Controllers",
            "$module/database/factories",
            "$module/database/migrations",
            "$module/database/seeds",
            "$module/Models",
            "$module/Observers",
            "$module/Providers",
            "$module/Repositories",
            "$module/Requests",
            "$module/Resources",
            "$module/routes",
            "$module/views",
        ];

        $this->line('');
        foreach ($directories as $directory) {
            $this->files->makeDirectory($directory, 0755, true, true);
            $this->line(' - Directory created at <fg=green>'.$directory.'</>');
        }
        $this->line('');
    }

    /**
     * Generate the module files.
     *
     * @return void
     */
    protected function generateFiles()
    {
        if ($this->option('empty')) {
            return;
        }

        $name = $this->argument('name');
        $module = basename($this->path);

        foreach ([
            // Generate menus file in config/menus.php
            'forge:menus' => [
                '--module' => $module,
            ],

            // Generate permissions file in config/permissions.php.
            'forge:permissions' => [
                '--module' => $module,
            ],

            // Generate controller file in
            // Controllers/$nameController.php
            'forge:controller' => [
                'name' => $name.'Controller',
                '--admin' => true,
                '--model' => $name,
                '--module' => $module,
            ],

            //
        ] as $command => $options) {
            $this->call($command, $options);
        }
    }
}
