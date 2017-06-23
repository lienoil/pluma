<?php

namespace Auth\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectToDashboardIfAuthenticated
{
    /**
     * The redirect path when authenticated.
     *
     * @var string
     */
    protected $redirectPath = '/admin/dashboard';

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
        if (Auth::guard($guard)->check()) {
            $this->redirectPath = config('admin.slug.dashboard', $this->redirectPath);

            return redirect($this->redirectPath);
        }

        return $next($request);
    }
}
