<?php

namespace Frontier\Support\Sidebar;

use Crowfeather\Traverser\Traverser;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Pluma\Support\Auth\User;

class Sidebar
{
    /**
     * The menus array.
     *
     * @var array
     */
    public $menus = [];

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
     * Assign the array of menus on a publicly accessible variable.
     *
     * @param array $menus
     */
    public function __construct($menus = null)
    {
        $this->menus = $menus;
    }

    /**
     * Retrieve the menus instance.
     *
     * @return mixed
     */
    public function menus()
    {
        return collect(json_decode(json_encode($this->menus)));
    }

    /**
     * Alias for menus
     *
     * @return mixed
     */
    public function all()
    {
        return $this->menus();
    }

    /**
     * Retrieve the current menu if exists.
     *
     * @return mixed
     */
    public function current()
    {
        return $this->find($this->getCurrentRouteName());
    }

    /**
     * Retrieve the parent of the current menu.
     *
     * @return mixed
     */
    public function parent()
    {
        $parent = $this->current()->parent ?? $this->current();

        return $this->find($parent);
    }

    /**
     * Retrieve the given menu via code attribute.
     *
     * @param string $code
     * @param string $key
     * @param array $menus
     * @return mixed
     */
    public function find($code, $key = 'code', $menus = null)
    {
        $iterator = new \RecursiveArrayIterator($menus ?? $this->menus()->toArray());
        $menus = new \RecursiveIteratorIterator(
            $iterator,
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($menus as $name => $menu) {
            if ($name === $code) {
                return $menu;
            }
        }
    }

    /**
     * Render as html the sidebar menus.
     *
     * @return mixed
     */
    public function render()
    {
        return $this->handle();
    }

    /**
     * Retrieve the sidebar menus as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return collect($this->render())->toArray();
    }

    /**
     * Generates the sidebar menus.
     *
     * @return array
     */
    protected function handle()
    {
        return collect(json_decode(json_encode($this->menus)));
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
}
