<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Support\Facades\File;
use Pluma\Support\Console\Command;
use Pluma\Support\Filesystem\Filesystem;

class ForgeControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:controller
                           {name=null : The controller to create}
                           {--m|module=none : Specify the module it belongs to, if applicable}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a generic controller';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        try {
            $name = studly_case($this->argument('name'));
            $slug = strtolower(str_slug($name));
            $option = $this->option();
            $module = get_module($option['module']);
            $modules = get_modules_path(true);

            if ($this->argument('name') === 'null' || is_null($name)) {
                $name = $this->ask("Please specify the controller name: (e.g. QuestController)");
            }

            if ($option['module'] === 'none' || is_null($module)) {
                $module = get_module($option['module']);

                if (is_null($module)) {
                    $this->error("Please specify the module this controller belongs to.");
                    $module = $this->choice("What module to put '$name' in?", $modules);
                    $module = get_module($module);
                }

                $this->info("Using path: $module");
            }

            $files = [
                "$module/Controllers/{$name}.php",
            ];

            foreach ($files as $file) {
                $namespace = basename($module);
                $model = basename($module);
                $slug = strtolower(str_plural($namespace));
                $template = $filesystem->put(
                    blacksmith_path("templates/controllers/ControllerAdmin.stub"),
                    compact('model', 'namespace', 'name', 'slug')
                );

                if ($filesystem->make($file, $template)) {
                    $this->info("File created: $file");
                }
            }

            exec("composer dump-autoload -o");
        } catch (\Pluma\Support\Filesystem\FileAlreadyExists $e) {
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
            $this->error(" ".$e->getMessage()." ");
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
        } catch (\Exception $e) {
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
            $this->error(" ".$e->getMessage()." ");
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
        }
    }
}
