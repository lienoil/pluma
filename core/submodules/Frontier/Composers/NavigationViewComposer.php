<?php

namespace Frontier\Composers;

use Frontier\Support\Traverser\Traverser;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use Pluma\Support\Composers\BaseViewComposer;
use Pluma\Support\Modules\Traits\Module;

class NavigationViewComposer extends BaseViewComposer
{
    use Traverser, Module;

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        parent::compose($view);

        $this->setVariablename("navigation");

        // $view->with($this->getVariablename(), $this->handle());
    }

    /**
     * Handles the view to compose.
     *
     * @return Object|StdClass
     */
    private function handle()
    {
        return json_decode(json_encode([
            'menu' => $this->menu(),
            'sidebar' => $this->sidebar(),
            // 'utilitybar' => $this->utilitybar(),
        ]));
    }

    /**
     * Generates menus.
     *
     * @return array
     */
    private function menu()
    {
        // return json_decode(json_encode([
        //     'make' => $make;
        // ]));
    }

    /**
     * Generates sidebar menus.
     *
     * @return array
     */
    private function sidebar()
    {
        $modules = modules(true, null, false);
        $menus = $this->requireFileFromModules('config/menus.php', $modules);

        $this->setTraversables($menus);
        $this->prepareTraverables('root', 1);
        $menus = $this->rechildTraversables($this->getTraversables(), 'root');

        $return = json_decode(json_encode([
            'generate' => $this->generateSidebar($menus),
        ]));
    }

    private function generateSidebar($menus)
    {
        // dd($menus);
    }

}
