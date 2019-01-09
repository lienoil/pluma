<?php

namespace Frontier\Composers;

use Crowfeather\Traverser\Traverser;
use Frontier\Support\Sidebar\Sidebar;
use Illuminate\Support\Facades\Cache;
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
        $this->modules = $this->getFileFromModules('config/menus.php');
        $sidebar = new Sidebar($this->menus());
        $sidebar->setCurrentRouteName($this->getCurrentRouteName());
        $sidebar->setCurrentUrl($this->getCurrentUrl());

        return $sidebar;
    }

    /**
     * Generate menus from modules.
     *
     * @return array
     */
    protected function menus()
    {
        $this->generateMenusFromModules($this->modules);
        $this->buildMenus(new Traverser());

        return $this->menus;
    }

    /**
     * Builds the menus array.
     *
     * @return array
     */
    protected function buildMenus(Traverser $traverser)
    {
        $traverser->set($this->menus)->flatten();
        $traverser->prepare();
        $name = 'sidebar:'.$this->user->displayrole;

        // Cache
        $this->menus = Cache::rememberForever($name, function () use ($traverser) {
            $this->menus = $traverser->get();
            $this->menus = $traverser->rechild('root');
            $this->menus = $traverser->reorder($this->menus);
            $this->menus = $traverser->update($this->menus, function ($key, &$menu, &$parent, &$all) {
                // Set URL
                $menu['url'] = $menu['url'] ?? $menu['slug'] ?? false;
                if (! isset($menu['code'])) {
                    $menu['code'] = $menu['name'];
                }

                // Header
                $menu['is_header'] = $menu['is_header'] ?? false;
                $menu['is_divider'] = $menu['is_divider'] ?? false;
            });

            return $this->menus;
        });

        /**
         * We need to update the active states of the menus each time the page loads.
         *
         */
        $this->menus = $traverser->update($this->menus, function ($key, &$menu, &$parent, &$all) {
            $menu['url'] = $menu['url'] ?? $menu['slug'] ?? false;
            // Set Active Status
            $menu['active'] = url($this->getCurrentUrl()) === $menu['url'];
            $menu['routeractive'] = $menu['active'];
            if ($menu['active']) {
                $parent['active'] = $menu['active'];
            }

            // Set Permission key
            if (isset($menu['code'])) {
                $menu['permission'] = $menu['permission'] ?? $menu['code'];
            }

            // Set route name
            if (isset($menu['routename'])) {
                $parent['active'] = $menu['active'];
            }

            /**
             * Child hidden routes
             * ['routes']['children'] are routes not present in the sidebar menus
             * but is still under a parent sidebar menu.
             * E.g.
             * User (user)
             * -- All Users (users.index)
             * ---- Show User (users.show)  <------- This is not part of the sidebar menu.
             * -- Create User (users.create)
             * -- Trashed Users (users.trashed)
             * =======
             * The above example shows `users.show` to be under `users.index`, therefore
             * we need to put an `active` flag on `users.index` and `user` when we are in the
             * `users.show` page.
             */
            $childRoutes = isset($menu['routes']['children']) ? $menu['routes']['children'] : [];
            $currentRouteName = $this->getCurrentRouteName();
            if ($menu['child']['active'] = in_array($currentRouteName, $childRoutes)) {
                // This is the main sidebar menu
                $parent['active'] = $menu['child']['active'];
                // This is the main sidebar menu's submenu
                $menu['active'] = $menu['child']['active'];
            }

            // Misc
            $menu['exclude_from_root'] = $menu['exclude_from_root'] ?? false;

            // Set User Visibility
            $menu['can_be_accessed'] = $menu['can_be_accessed'] ?? $this->userIsRoot();

            $menu['always_viewable'] = $menu['always_viewable']
                ?? $menu['name'] === 'root'
                ?? false;

            if (($this->userIsNotRoot()
                    && $this->user->can($menu['permission'] ?? $menu['code'] ?? false)
                )
                || ($menu['always_viewable'])
                || ($menu['is_header'])
                || ($menu['name'] === 'root')
            ) {
                $menu['can_be_accessed'] = true;
            }

            if ($menu['exclude_from_root']) {
                if ($this->user && $this->user->isSuperAdmin()) {
                    $menu['can_be_accessed'] = false;
                }
            }

            // Menu accessibility
            if (! $menu['can_be_accessed']) {
                if (! $menu['is_parent'] && $menu['name'] !== 'root') {
                    unset($parent['children'][$menu['name']]);
                }

                // Remove any top level menu with `hidden` attribute
                if (isset($menu['hidden']) && $menu['hidden'] && is_null($parent)) {
                    unset($all[$menu['name']]);
                }
            }
        });

        $this->menus = $traverser->update($this->menus, function ($key, &$menu, &$parent, &$all) {
            if (empty($menu['children']) && ! $menu['can_be_accessed']) {
                unset($all[$key]);
            }

            if ($menu['is_parent'] && $menu['parent'] == 'root' && empty($menu['children'])) {
                unset($all[$key]);
            }
        });

        $this->menus = $traverser->update($this->menus, function ($key, &$menu, &$parent, &$all) {
            if (count($menu['children']) == 1) {
                $firstChild = collect($menu['children'])->first();
                if ($firstChild['is_header'] || $firstChild['is_divider']) {
                    unset($all[$key]);
                }
            }

            if (count($menu['children']) <= 2) {
                $firstChild = collect($menu['children'])->first();
                if ($firstChild['is_header'] || $firstChild['is_divider']) {
                    unset($menu['children'][$firstChild['name']]);
                }
            }

            if ($menu['is_header']) {
                $nextMenu = current(array_slice($all, array_search($key, array_keys($all)) + 1, 1));
                if ($nextMenu && $nextMenu['is_header']) {
                    unset($all[$key]);
                }
            }

            /**
             * Another way to remove separators.
             * Check if permission key exists.
             */
            if ($menu['is_divider'] || $menu['is_header']) {
                if ((isset($menu['always_viewable']) && ! $menu['always_viewable']) || ! isset($menu['always_viewable'])) {
                    if ($this->user->cannot($menu['permission'] ?? $menu['code'] ?? false)) {
                        unset($all[$key]);
                    }
                }
            }
        });
    }

    /**
     * Retrieves the menus from files on each modules.
     *
     * @param array $modules
     * @return void
     */
    protected function generateMenusFromModules($modules)
    {
        $this->menus = Cache::rememberForever('sidebar:menus', function () use ($modules) {
            $menus = [];

            foreach ($modules as $module) {
                $module = require $module;
                $menus = array_merge($menus, $module);
            }

            return $menus;
        });
    }

    /**
     * Shorthand for checking user belongs to root.
     *
     * @return boolean
     */
    protected function userIsRoot()
    {
        return $this->user && $this->user->isRoot();
    }

    /**
     * Shorthand for checking user does not belong to root.
     *
     * @return boolean
     */
    protected function userIsNotRoot()
    {
        return $this->user && ! $this->user->isRoot();
    }
}
