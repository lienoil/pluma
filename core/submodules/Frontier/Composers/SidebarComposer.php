<?php

namespace Frontier\Composers;

use Crowfeather\Traverser\Traverser;
use Frontier\Support\Sidebar\Sidebar;
use Illuminate\View\View;
use Pluma\Support\Composers\BaseViewComposer;
use Pluma\Support\Modules\Traits\ModulerTrait;

class SidebarComposer extends BaseViewComposer
{
    use ModulerTrait;

    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'sidebar';

    /**
     * Array of menus.
     *
     * @var array
     */
    protected $menus = [];

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with($this->name, $this->handle());
    }

    /**
     * Generates the sidebar instance.
     *
     * @return array
     */
    public function handle()
    {
        return new Sidebar();
    }
}
