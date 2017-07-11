<?php

namespace Frontier\Composers;

use Crowfeather\Traverser\Traverser;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use Pluma\Support\Composers\BaseViewComposer;
use Pluma\Support\Modules\Traits\Module;

class NavigationViewComposer extends BaseViewComposer
{
    use Module;

    /**
     * Starting depth of the traversables.
     *
     * @var integer
     */
    protected $depth = 1;

    /**
     * The navigational menu.
     *
     * @var array|object|mixed
     */
    protected $menus;

    /**
     * Prefix for url.
     *
     * @var string
     */
    protected $urlPrefix;

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        parent::compose($view);

        $this->setMenus($this->requireFileFromModules('config/menus.php', modules(true, null, false)));

        $this->setVariablename("navigation");

        $view->with($this->getVariablename(), $this->handle());
    }

    /**
     * Sets the menus.
     *
     * @param array|object|mixed $menus
     */
    public function setMenus($menus)
    {
        $traverser = new Traverser();
        $traverser->set($menus)
                ->flatten()
                ->prepare();

        $this->menus = $traverser->rechild('root');
        $this->menus = $traverser->reorder($this->menus);

        return $this;
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
        //
    }

    /**
     * Generates sidebar menus.
     *
     * @return array
     */
    private function sidebar()
    {
        return json_decode(json_encode([
            'generate' => $this->generateSidebar(collect(json_decode(json_encode($this->menus)))),
            'collect' => collect(json_decode(json_encode($this->menus))),
        ]));
    }

    /**
     * Generate sidebar.
     *
     * @param  object $menus
     * @return html|string
     */
    private function generateSidebar($menus)
    {
        $depth = $this->depth;

        return view("Frontier::templates.sidebar")->with(compact('menus', 'depth'))->render();
    }
}
