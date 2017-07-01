<?php

namespace Pluma\Support\Composers;

use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

/**
 * Base View Composer
 * -------------------------
 * A class to which other view
 * composers can extend to.
 *
 */
class BaseViewComposer
{
    /**
     * The page's current url.
     *
     * @var string
     */
    protected $currentUrl;

    /**
     * The view's variable.
     *
     * @var string
     */
    protected $variablename;

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->setCurrentUrl(Request::path());
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
     * Sets the variable name.
     *
     * @param string $name
     */
    protected function setVariablename($name)
    {
        $this->variablename = $name;
    }

    /**
     * Gets the variable name value.
     *
     * @return string
     */
    public function getVariablename()
    {
        return $this->variablename;
    }
}
