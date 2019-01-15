<?php

namespace Pluma\Support\Composers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use User\Models\User;

class BaseViewComposer
{
    /**
     * The page's current url.
     *
     * @var string
     */
    protected $currentUrl;

    /**
     * The current route instance.
     *
     * @var string
     */
    protected $currentRouteName;

    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name;

    /**
     * The currently logged in user.
     *
     * @var \User\Models\User
     */
    protected $user;

    /**
     * Initialize the base composer class.
     *
     */
    public function __construct()
    {
        $this->setCurrentUrl(Request::path());

        $this->setCurrentRouteName(Route::currentRouteName());

        $this->setName($this->name);

        $this->user = user();
    }

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with($this->name(), $this->handle());
    }

    /**
     * Sets the current url.
     *
     * @param string $urlPath
     */
    public function setCurrentUrl($urlPath)
    {
        $this->currentUrl = rtrim($urlPath, '/');
    }

    /**
     * Gets the current url value.
     *
     * @return string
     */
    public function getCurrentUrl()
    {
        return $this->currentUrl ?? Route::current()->uri();
    }

    /**
     * Sets the current route.
     *
     * @param string $currentRouteName
     */

    public function setCurrentRouteName($currentRouteName)
    {
        $this->currentRouteName = $currentRouteName;
    }

    /**
     * Gets the current route value.
     *
     * @return string
     */
    public function getCurrentRouteName()
    {
        return $this->currentRouteName;
    }

    /**
     * Check if route exists.
     *
     * @param  string  $url
     * @return boolean
     */
    public function hasRouteNameFromUrl($url)
    {
        return (bool) $this->getRouteNameFromUrl($url);
    }

    /**
     * Try to guess the route name of the given url.
     *
     * @return string
     */
    public function getRouteNameFromUrl($url)
    {
        try {
            $app = app('router')
                    ->getRoutes()
                    ->match(
                        app('request')->create($url)
                    )->getName();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $app ?? '';
    }

    /**
     * Sets the variable name.
     *
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Gets the variable name value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Alias for getName
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Swap words from config/swappables.php
     *
     * @param  string $segment
     * @return string
     */
    public function swapWord($segment)
    {
        foreach (config("swappables", []) as $name => $swap) {
            if (strtolower($name) === strtolower($segment)) {
                return $swap;
            }
        }

        return $segment;
    }

    /**
     * Get all the modules.
     *
     * @return array
     */
    public function modules()
    {
        return get_modules_path();
    }

    /**
     * Performs a string transformation to
     * huma-readable word(s).
     *
     * @param  string $string
     * @return string
     */
    public function transformStringToHumanPresentable($string)
    {
        $string = str_replace('-', " ", $string);
        $string = str_replace('.', " ", $string);
        $string = str_replace('_', " ", $string);

        return $c ?? ucwords($string);
    }

    /**
     * Utility to convert config files to array.
     *
     * @param array $files
     * @return array
     */
    protected function fileToArray(array $files): Array
    {
        $items = [];
        foreach ($files as $path) {
            if (file_exists($path)) {
                $items += (array) require $path;
            }
        }

        return $items;
    }

    /**
     * Try to get the column `code` from the database.
     *
     * @param  int $segment
     * @param  string $url
     * @return string
     */
    public function guessStringFromNumeric($segment, $url)
    {
        try {
            $action = request()->route()->getAction();
            $controller = class_basename($action['controller']);
            $table = strtolower(str_plural(explode("Controller", $controller)[0]));
            $result = \Illuminate\Support\Facades\DB::table($table)->find($segment);

            if (isset($result->title)) {
                $segment = $result->title;
            } elseif (isset($result->name)) {
                $segment = $result->title;
            } elseif (isset($result->code)) {
                $segment = $result->code;
            } else {
                $segment = $segment;
            }
        } catch (\Exception $e) {
            return $segment;
        }

        return $segment;
    }

    /**
     * Remove all routes the user is
     * restricted access.
     *
     * @param  array $menus
     * @return void
     */
    public function unsetForbiddenRoutes(&$menus = null)
    {
        if (user() && user()->isRoot()) {
            return $menus;
        }

        $menus = is_null($menus) ? $this->menus : $menus;

        foreach ($menus as $i => &$menu) {
            if (isset($menu['children']) && ! empty($menu['children'])) {
                $menu['children'] = $this->unsetForbiddenRoutes($menu['children']);
            }

            if ((! $menu['can_be_accessed'] && ! $menu['is_parent']) ||
                (! $menu['can_be_accessed'] && $menu['is_parent'] && empty($menu['children']))) {
                unset($menus[$i]);
            }
        }

        return $menus;
    }
}
