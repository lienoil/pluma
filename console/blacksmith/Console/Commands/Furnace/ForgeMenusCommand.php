<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\Command;

class ForgeMenusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:menus
                           {name=menus : The model to create}
                           {--m|module=none : Specify the module it belongs to, if applicable}
                           ';

    public function handle()
    {
        // $name = studly_case($this->argument('name'));
        // $code = str_singular($slug);
        // $template = $filesystem->put(
        //     blacksmith_path("templates/config/menus.stub"),
        //     compact('code', 'module', 'name', 'slug')
        // );
    }
}
