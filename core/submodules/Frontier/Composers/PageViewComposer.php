<?php

namespace Frontier\Composers;

use Frontier\Models\Page;
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
        return json_decode(json_encode([
            'head' => $this->head(),
            'body' => $this->body(),
            'page' => $this->page(),
            'footer' => $this->footer(),
        ]));
    }

    private function head()
    {
        return json_decode(json_encode([
            'title' => config("settings.site.title", env("APP_NAME", "Pluma CMS")),
            'subtitle' => $this->guessSubtitle($this->currentUrl),
            'separator' => config("settings.site.title_separator", '|'),
            'description' => $this->guessDescription(),
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
            'title' => $this->guessTitle($this->currentUrl),
            'subtitle' => $this->guessSubtitle($this->currentUrl),
        ]));
    }

    private function footer()
    {
        return json_decode(json_encode([]));
    }

    /**
     * Guesses the page title.
     * Looks in the database first,
     * if nothing found, then it will try to
     * construct words based from url.
     *
     * @param  string $url
     * @return void
     */
    public function guessTitle($url)
    {
        // $page = Page::whereSlug($url)->get();

        // if ($page->exists()) {
        //     return $page->title;
        // }

        $segments = collect(explode("/", $url));

        if (empty($segments->first())) {
            return config("settings.pages.default_name", "Home");
        }

        return ucwords("{$segments->last()} {$segments->first()}");
    }

    /**
     * Guesses the page subtitle.
     * Looks in the database first,
     * if nothing found, then it will try to
     * construct words based from url.
     *
     * @param  string $url
     * @return void
     */
    public function guessSubtitle($url)
    {
        $segments = collect(explode("/", $url));

        if (empty($segments->first())) {
            return "| " . config("settings.site.subtitle", env("APP_TAGLINE"));
        }

        return '| ' . config("settings.site.title", env("APP_NAME"));
    }

    /**
     * Guesses the page description.
     * Looks in the database first,
     * if nothing found, then it will try to
     * construct words based from url.
     *
     * @return void
     */
    public function guessDescription()
    {
        $description = "";
        // else check database....
        // ....

        if (empty($this->currentUrl) || empty($description)) {
            $description = env("APP_TAGLINE");
        }

        // else
        return $description;
    }
}
