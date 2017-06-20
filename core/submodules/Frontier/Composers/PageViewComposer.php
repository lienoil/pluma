<?php

namespace Frontier\Composers;

use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

/**
 * Page View Composer
 * -------------------------
 * The view composer for dynamic headings,
 * subheading, and other content on page.
 *
 */
class PageViewComposer
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
     * @var
     */
    protected $variablename = "application";

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
    }

    private function handle()
    {
        $r = json_decode(json_encode([
            'head' => $this->head(),
            'body' => $this->body(),
            'page' => $this->page(),
            'footer' => $this->footer(),
        ]));

        dd($r->head->name);
    }

    private function head()
    {
        return json_decode(json_encode([
            'title' => config("settings.site.title", env("APP_NAME", "Pluma CMS")),
            'subtitle' => config("settings.site.subtitle", env("APP_TAGLINE")),
            'name' => config("settings.site.title", env("APP_NAME", "Pluma CMS")),
            'tagline' => config("settings.site.subtitle", env("APP_TAGLINE")),
        ]));
    }

    private function body()
    {
        return json_decode(json_encode([]));
    }

    private function page()
    {
        return json_decode(json_encode([
            'title' => $this->guessPageTitle($this->currentUrl),
            'subtitle' => "",
        ]));
    }

    private function footer()
    {
        return json_decode(json_encode([]));
    }

    public function guessPageTitle($url)
    {
        $page = Page::whereSlug($url)->get();

        if ($page->exists()) {
            return $page->title;
        }

        $segments = collect(explode("/", $url));

        if (empty($url->first())) {
            // $url->first()"Home";
        }

        dd($url);
    }
}
