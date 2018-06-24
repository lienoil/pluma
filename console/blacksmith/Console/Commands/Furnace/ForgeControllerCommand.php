<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\File;
use Pluma\Support\Filesystem\Filesystem;
use Pluma\Support\Modules\Traits\ModulerTrait;

class ForgeControllerCommand extends GeneratorCommand
{
    use ModulerTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:controller
                           {name : The controller to create}
                           {--m|module=none : Specify the module it belongs to, if applicable}
                           {--a|admin : Specify the controller extends the Admin Controller}
                           {--p|public : Specify the controller extends the Public Controller}
                           {--api : Specify the controller extends the Api Controller}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a generic controller';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * The Composer instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Support\Composer  $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files);

        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (! $module = $this->input->getOption('module')) {
            $module = $this->getModulePath(
                $this->choice("Specify the module the seeder will belong to.", $this->modules());
            );
        }
        dd($module);

        $this->input->setOption('module', $module);

        parent::handle();

        $this->composer->dumpAutoloads();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return blacksmith_path('templates/controllers/Controller.stub');
    }
}
