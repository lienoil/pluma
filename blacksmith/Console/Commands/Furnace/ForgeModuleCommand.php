<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Support\Facades\File;
use Pluma\Support\Console\Command;
use Pluma\Support\Filesystem\Filesystem;

class ForgeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:module
                           {name : The module to create}
                           {--m|module=none : Specify the module it belongs to, if applicable}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the directories for the module';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $name = studly_case($this->argument('name'));
        $slug = strtolower(str_slug($name));
        $option = $this->option();
        $module = modules_path($name);
        $modules = get_modules_path(true);

        if ($option['module'] !== 'none') {
            // The its a submodule
            $submodule = $name;
            $module = get_module($option['module']);
            if (is_null($module)) {
                $this->error("{$option['module']} Does not exist.");
                $chosen = $this->choice("Do you want to create the {$option['module']} module?", ['yes', 'choose from existing modules', 'cancel']);

                switch ($chosen) {
                    case 'choose from existing modules':
                        $module = $this->choice("What module to put '$name' in?", $modules);
                        $module = get_module($module);
                        break;

                    case 'yes':
                        $module = modules_path($option['module']);
                        break;

                    case 'cancel':
                    default:
                        exit();
                        break;
                }
                if ($chosen == 'choose from existing modules') {
                }
            }

            $module = "$module/submodules/$submodule";
            $this->info("Using path: $module");
        }

        // Create the module files
        $directories = [
            "$module/assets",
            "$module/config",
            "$module/Controllers",
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

        $slug = str_plural($slug);
        $files = [
            "$module/config/menus.php",
            "$module/config/permissions.php",
            "$module/Controllers/{$name}Controller.php",
            "$module/Models/{$name}.php",
            "$module/Observers/{$name}Observer.php",
            "$module/Providers/{$name}ServiceProvider.php",
            "$module/Requests/{$name}Request.php",
            "$module/routes/admin.php",
            "$module/routes/public.php",
            "$module/views/$slug/create.blade.php",
            "$module/views/$slug/edit.blade.php",
            "$module/views/$slug/index.blade.php",
            "$module/views/$slug/trash.blade.php",
        ];
        foreach ($files as $file) {
            switch ($file) {
                case "$module/Controllers/{$name}Controller.php":
                    $template = $filesystem->put(
                        blacksmith_path("templates/controllers/ControllerAdmin.stub"),
                        compact('file', 'module', 'name', 'slug')
                    );
                    break;

                case "$module/views/$slug/create.blade.php":
                case "$module/views/$slug/edit.blade.php":
                case "$module/views/$slug/index.blade.php":
                case "$module/views/$slug/trash.blade.php":
                    $template = $filesystem->put(
                        blacksmith_path("templates/views/generic.stub"),
                        []
                    );
                    break;

                case "$module/Requests/{$name}Request.php":
                    $code = str_singular($slug);
                    $template = $filesystem->put(
                        blacksmith_path("templates/requests/FormRequest.stub"),
                        compact('code', 'name', 'slug')
                    );
                    break;

                case "$module/Providers/{$name}ServiceProvider.php":
                    $template = $filesystem->put(
                        blacksmith_path("templates/providers/ServiceProvider.stub"),
                        compact('file', 'module', 'name', 'slug')
                    );
                    break;

                case "$module/Observers/{$name}Observer.php":
                    $template = $filesystem->put(
                        blacksmith_path("templates/observers/Observer.stub"),
                        compact('file', 'module', 'name', 'slug')
                    );
                    break;

                case "$module/Models/{$name}.php":
                    $template = $filesystem->put(
                        blacksmith_path("templates/models/Model.stub"),
                        compact('file', 'module', 'name', 'slug')
                    );
                    break;

                case "$module/config/menus.php":
                    $code = str_singular($slug);
                    $template = $filesystem->put(
                        blacksmith_path("templates/config/menus.stub"),
                        compact('code', 'module', 'name', 'slug')
                    );
                    break;

                case "$module/config/permissions.php":
                    $code = str_singular($slug);
                    $template = $filesystem->put(
                        blacksmith_path("templates/config/permissions.stub"),
                        compact('code', 'module', 'name', 'slug')
                    );
                    break;

                case "$module/routes/admin.php":
                case "$module/routes/public.php":
                    $code = str_singular($slug);
                    $template = $filesystem->put(
                        blacksmith_path("templates/routes/route.stub"),
                        compact('code', 'module', 'name', 'slug')
                    );
                    break;

                default:
                    $template = "<?php ";
                    break;
            }
            if ($filesystem->make($file, $template)) {
                $this->info("File created: $file");
            }
        }

        exec("composer dump-autoload -o");
    }
}
