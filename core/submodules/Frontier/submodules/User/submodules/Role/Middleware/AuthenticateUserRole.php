<?php

namespace Role\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Role\Support\Roles\Roles;

class AuthenticateUserRole
{
    /**
     * Array of roles.
     *
     * @var array
     */
    protected $roles;

    /**
     * Array of permissions.
     *
     * @var array
     */
    protected $permissions;

    /**
     * The route instance.
     *
     * @var \Illuminate\Routing\Router
     */
    protected $route;

    /**
     * Construct method.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->route = $request->route();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  roles
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->setPermissions();
        $this->roles = $this->roles($request);

        $actions = $request->route()->getAction();
        $request->route()->setAction($actions + ['auth.roles' => $this->roles]);

        // check if user has the role specified.
        if (($this->isAlwaysViewable($request->url())) ||
            ($request->user() &&
                ($request->user()->isRoot() ||
                    $request->user()->hasRole($this->roles)))) {
            return $next($request);
        }

        return response()->view("Theme::errors.403", [], 403);
    }

    /**
     * Sets the Permissions.
     *
     */
    public function setPermissions()
    {
        if (isset(auth()->user()->roles)) {
            foreach (auth()->user()->roles as $role) {
                foreach ($role->grants as $grant) {
                    foreach ($grant->permissions as $permission) {
                        $this->permissions[] = $permission;
                    }
                }
            }
        }
    }

    /**
     * Gets all the user's roles.
     *
     * @param  Request $request
     * @return array
     */
    public function roles(Request $request)
    {
        if (App::runningInConsole()) {
            return [];
        }

        $roles = [];
        foreach ($this->permissions() as $permission) {
            if (! empty($request) &&
                isset($request->route()->getAction()['as']) &&
                $request->route()->getAction()['as'] == $permission->name) {
                $roles[] = $permission->roles;
            }
        }

        if ($roles) {
            foreach ($roles as $collection) {
                if ($collection) {
                    foreach ($collection as $role) {
                        $this->roles[] = $role->code;
                    }
                }
            }
        }

        return $this->roles;
    }

    /**
     * Gets the permissions array.
     *
     * @return array
     */
    protected function permissions()
    {
        return $this->permissions ? $this->permissions : [];
    }

    /**
     * Checks if the menu is tagged as 'always_viewable'
     *
     * @param  string  $url
     * @return boolean
     */
    protected function isAlwaysViewable($url)
    {
        foreach (get_menus() as $file) {
            $menus = (array) require $file;

            foreach ($menus as $name => $menu) {
                if (isset($menu['always_viewable']) &&
                    isset($menu['slug']) &&
                    $url === $menu['slug'] &&
                    $menu['always_viewable']) {
                    return true;
                }
            }
        }

        return false;
    }
}
