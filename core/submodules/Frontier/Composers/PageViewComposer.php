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
     * Array of banned words.
     * Banned words will help filter out
     * unwanted words when guessing the title
     * for the page.
     * E.g. a url with "/admin/login" will
     * generate a "Login Admin" title.
     * Registering the "admin" word as banned
     * will generate a much intuitive "Login"
     * for the title.
     *
     * @var array
     */
    protected $bannedFirstWords = ['admin', 'administration'];

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
            'site' => $this->site(),
            'head' => $this->head(),
            'body' => $this->body(),
            'page' => $this->page(),
            'footer' => $this->footer(),
        ]));
    }

    private function site()
    {
        return json_decode(json_encode([
            'title' => config("settings.site.title", env("APP_NAME", "Pluma CMS")),
            'tagline' => config("settings.site.tagline", env("APP_TAGLINE")),
            'author' => config("settings.site.author", env("APP_AUTHOR")),
            'copyright' => $this->guessCopyright(),
        ]));
    }

    private function head()
    {
        return json_decode(json_encode([
            'title' => $this->guessTitle(),
            'subtitle' => $this->guessSubtitle(),
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
     * @return void
     */
    public function guessTitle()
    {
        $segments = collect(explode("/", $this->currentUrl));

        if (empty($segments->first())) {
            return config("settings.pages.default_name", "Home");
        }

        if (in_array($segments->first(), $this->bannedFirstWords)) {
            return ucwords("{$segments->last()}");
        }

        return $segments->last() != $segments->first()
                ? ucwords("{$segments->last()} {$segments->first()}")
                : ucwords("{$segments->first()}");
    }

    /**
     * Guesses the page subtitle.
     * Looks in the database first,
     * if nothing found, then it will try to
     * construct words based from url.
     *
     * @return void
     */
    public function guessSubtitle()
    {
        $segments = collect(explode("/", $this->currentUrl));

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
        // TODO: perform a try > $description = Page::whereSlug($this->currentUrl)->first()->description...

        if (empty($this->currentUrl) || empty($description)) {
            $description = env("APP_TAGLINE");
        }

        return $description;
    }

    /**
     * Guesses the page copyright.
     * Looks in the database first,
     * if nothing found, then it will try to
     * construct words based from url.
     *
     * @return void
     */
    public function guessCopyright()
    {
        $blurb = config("settings.site.copyright", env("APP_COPYRIGHT"));

        $blurb = preg_replace("/\{APP_NAME\}/", env("APP_NAME"), $blurb);
        $blurb = preg_replace("/\{APP_TAGLINE\}/", env("APP_TAGLINE"), $blurb);
        $blurb = preg_replace("/\{APP_YEAR\}/", env("APP_YEAR"), $blurb);
        $blurb = preg_replace("/\{APP_AUTHOR\}/", env("APP_AUTHOR"), $blurb);
        $blurb = preg_replace("/\{CURRENT_YEAR\}/", date('Y'), $blurb);

        $copy = preg_replace(
                "/\{APP_YEAR_TO_CURRENT_YEAR\}/",
                (env("APP_YEAR", date('Y')) < date('Y')
                    ? env("APP_YEAR") . " - " . date('Y')
                    : date('Y')),
                $blurb
            );

        return $copy;
    }
}
