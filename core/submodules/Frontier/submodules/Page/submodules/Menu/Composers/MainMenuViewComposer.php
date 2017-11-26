<?php

namespace Menu\Composers;

use Crowfeather\Traverser\Traverser;
use Illuminate\View\View;
use Menu\Models\Menu;
use Pluma\Support\Composers\BaseViewComposer;

class MainMenuViewComposer extends BaseViewComposer
{
    /**
     * The Traverser instance.
     * @var Crowfeather\Traverser\Traverser
     */
    protected $traverser;

    /**
     * The menu location.
     *
     * @var string
     */
    protected $location = 'main-menu';

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        parent::compose($view);

        $this->setVariablename('menus');

        $view->with($this->getVariablename(), $this->handle());
    }

    /**
     * Handles the view to compose.
     *
     * @return Object|StdClass
     */
    private function handle()
    {
        return json_decode(json_encode($this->menus()));
    }

    /**
     * Generate menus from database.
     *
     * @return array
     */
    private function menus()
    {
        try {
            $menus = Menu::menus($this->location);
            $menus = $this->setupRouting($menus);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return abort(500);
        }

        return $menus;
    }

    /**
     * Generate each menu's url.
     *
     * @param  array $menus
     * @return array
     */
    private function setupRouting($menus)
    {
        foreach ($menus as &$menu) {
            if (! is_null($menu['slug']) && ! empty($menu['slug'])) {
                $menu['url'] = $menu['slug'];
            } else {
                $menu['slug'] = "";
                $menu['url'] = '/';
            }

            $menu['url'] = isset($menu['is_absolute_slug']) && $menu['is_absolute_slug']
                         ? $menu['url']
                         : url($menu['url']);

            if ($this->getCurrentUrl() === $menu['slug']) {
                $menu['active'] = true;
            } else {
                $menu['active'] = false;
            }

            if (! empty($menu['children'])) {
                $menu['children'] = $this->setupRouting($menu['children']);

                if ($this->hasActiveChild($menu['children'])) {
                    $menu['active'] = true;
                }
            }
        }

        return $menus;
    }

    /**
     * Check if one of the children is active.
     *
     * @param  array  $children
     * @return boolean
     */
    public function hasActiveChild($children)
    {
        foreach ($children as $child) {
            if (isset($child['active']) && $child['active']) {
                return true;
            }
        }

        return false;
    }
}
