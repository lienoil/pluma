<?php

namespace Pluma\Support\Composers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

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
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->setCurrentUrl(Request::path());
        $this->setCurrentRouteName(Route::currentRouteName());
        $this->setName($this->name);

        $view->with($this->name(), $this->handle());
    }

    /**
     * Sets the current url.
     *
     * @param string $urlPath
     */
    protected function setCurrentUrl($urlPath)
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
        return $this->currentUrl;
    }

    /**
     * Sets the current route.
     *
     * @param string $currentRouteName
     */
    protected function setCurrentRouteName($currentRouteName)
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
}
