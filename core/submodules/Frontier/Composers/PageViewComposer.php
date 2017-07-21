<?php

namespace Frontier\Composers;

use Frontier\Models\Page;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use Pluma\Support\Composers\BaseViewComposer;

/**
 * Page View Composer
 * -------------------------
 * The view composer for dynamic headings,
 * subheading, and other content on page.
 *
 */
class PageViewComposer extends BaseViewComposer
{
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
    protected $bannedFirstWords = ['admin', 'administration', 'home'];

    /**
     * List fo single words to determin the correct
     * grammar. E.g. a url of "pages/create" will
     * yield "Create Page" instead of "Create Pages".
     *
     * @var array
     */
    protected $singles = ['create', 'new', 'edit', 'destroy', 'trash'];

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        parent::compose($view);

        $this->setVariablename("application");

        $view->with($this->getVariablename(), $this->handle());
    }

    private function handle()
    {
        return json_decode(json_encode([
            'site' => $this->site(),
            'head' => $this->head(),
            'body' => $this->body(),
            'page' => $this->page(),
            'footer' => $this->footer(),
            'version' => "v" . app()->version(),
            'token' => csrf_token(),
        ]));
    }

    private function site()
    {
        return json_decode(json_encode([
            'title' => config("settings.site.title", env("APP_NAME", "Pluma CMS")),
            'tagline' => config("settings.site.tagline", env("APP_TAGLINE")),
            'author' => config("settings.site.author", env("APP_AUTHOR")),
            'logo' => config("settings.site.logo", $this->getBrandLogoUrl()),
            'copyright' => $this->guessCopyright(),
            'fulltitle' => $this->guessTitle() . " " . $this->guessSubtitle(),
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
            'fulltitle' => $this->guessTitle() . " " . $this->guessSubtitle(),
        ]));
    }

    private function body()
    {
        return json_decode(json_encode([]));
    }

    private function page()
    {
        return json_decode(json_encode([
            'title' => $this->guessTitle($this->getCurrentUrl()),
            'subtitle' => $this->guessSubtitle($this->getCurrentUrl()),
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
        $segments = collect(explode("/", $this->getCurrentUrl()));

        foreach ($segments as $id => $segment) {
            $segments[$id] = $this->swapWord($segment);
        }

        if (empty($segments->first())) {
            return config("settings.pages.default_name", "Home");
        }

        if (count($segments) >= 3) {
            $end = $segments[sizeof($segments) - 1];

            if (! in_array($end, config('language.supported', []))) {
                if (in_array($segments[2], $this->singles)) {
                    $segments[1] = str_singular($segments[1]);
                }
                return $title = ucwords("{$segments[2]} {$segments[1]}");
            } else {
                $i = $segments[sizeof($segments) - 2];
                $j = $segments[sizeof($segments) - 3];

                if (in_array($segments->first(), $this->bannedFirstWords)) {
                    return ucwords("$i");
                } else {
                    return ucwords("$i $j");
                }
            }
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
        $segments = collect(explode("/", $this->getCurrentUrl()));

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
        // TODO: perform a try > $description = Page::whereSlug($this->getCurrentUrl())->first()->description...

        if (empty($this->getCurrentUrl()) || empty($description)) {
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

        // Translate
        foreach ($copy = explode(' ', $copy) as $i => $string) {
            $copy[$i] = __($string);
        }

        return implode(' ', $copy);
    }

    /**
     * Gets the Logo of the application
     *
     * @return string
     */
    public function getBrandLogoUrl()
    {
        $version = app()->version();

        if (file_exists(public_path('img/logos/main.png'))) {
            return url("img/logos/main.png?v=$version");
        }

        if (file_exists(public_path('logo.png'))) {
            return url("logo.png?v=$version");
        }

        return url("core/fallback/logos/main.png?v=$version");
    }
}
