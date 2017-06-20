<?php

namespace Pluma\Composers;

use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

/**
 * Application View Composer
 * -------------------------
 * The view composer for dynamic headings,
 * subheading, and other content on page.
 *
 */
class ApplicationViewComposer
{
    /**
     * The view's variable.
     *
     * @var
     */
    protected $variablename = "application";

    protected $head;

    protected $currentUrl;

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->setCurrentUrl(Request::path());

        $view->with($this->variablename, $this->handle());
    }

    private function setCurrentUrl($urlPath)
    {
        $this->currentUrl = rtrim($urlPath, '/');
        dd("ApplicationViewComposer", $this->currentUrl);
    }

    private function handle(View $view)
    {
        return collect([
            'head' => $this->head(),
            'body' => $this->getBody(),
            'footer' => $this->getFooter(),
        ]);
    }

    private function head()
    {
        $this->head = collect([
            'title' => env("APP_NAME", "")
        ]);

        return $this->head;
    }
}
