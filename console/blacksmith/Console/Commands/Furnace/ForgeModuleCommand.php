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
                           {--m|module= : The module the factory belongs to}
                           {--c|core : Specify the controller extends the Admin Controller}
                           {--p|public : Specify the controller extends the Public Controller}
                           {--g|general : Specify the controller extends the General purpose Controller}
                           {--api : Specify the controller extends the Api Controller}
                           {--model : Generate a resource controller for the given model}
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
        'core' => 'Core',
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
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $file
     * @param  \Illuminate\Support\Composer  $composer
     * @return void
     */
    public function __construct(Filesystem $file, Composer $composer)
    {
        parent::__construct($file);

        $this->filesystem = $file;

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

        if ($this->isSubmoduleLevel()) {
            $this->qualifyModule();
        }

        $this->qualifyPath();

        $this->generateModule();

        $this->composer->dumpAutoloads();
    }

    /**
     * Get the level of the module.
     *
     * @return void
     */
    protected function qualifyModuleLevel()
    {
        $name = $this->argument('name');

        $this->level = $this->choice("What type of module do you want create with $name?", $this->moduleLevels);
    }

    /**
     * Get the module the file belongs to.
     *
     * @return string
     */
    protected function qualifyModule()
    {
        $module = $this->input->getOption('module');

        if (! $module || ! $this->isModule($module)) {
            $module = $this->choice("Specify the module the submodule will belong to.", $this->modules());
        }

        $this->module = $this->getModulePath($module);

        $this->input->setOption('module', $this->module);

        return $this->module;
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
    protected function generateModule()
    {
        $module = $this->path;

        $directories = [
            "$module/config",
            "$module/Controllers",
            "$module/database/factories",
            "$module/database/migrations",
            "$module/database/seeds",
            "$module/Models",
            "$module/Observers",
            "$module/Providers",
            "$module/Requests",
            "$module/routes",
            "$module/views",
        ];

        foreach ($directories as $directory) {
            $filesystem->directory($directory, 0755, true, true);
            $this->info("Directory created: $directory");
        }
    }
}
