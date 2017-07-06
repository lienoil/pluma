<?php

namespace Pluma\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Session;

class Localization
{
    /**
     * Supported languages.
     *
     * @var array
     */
    protected $languages;

    /**
     * Subdomain string.
     *
     * @var string
     */
    protected $subdomain;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $this->languages = config()->get('language.supported', $this->languages);

        app()->setLocale(config()->get('language.locale', 'en'));

        $url = explode('.', parse_url($request->url(), PHP_URL_HOST));
        $this->subdomain = $url[0];

        if ($this->subdomain && in_array($this->subdomain, $this->languages)) {
            app()->setLocale($this->subdomain);
        }

        return $next($request);
    }
}
