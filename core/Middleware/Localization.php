<?php

namespace Pluma\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Session;

class Localization
{
    protected $languages = ['en', 'fil'];

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

        if (in_array(
            $language = last(explode('/', $request->path())),
            $this->languages)
        ) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
