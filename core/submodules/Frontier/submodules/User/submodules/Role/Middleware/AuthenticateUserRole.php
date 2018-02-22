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
<<<<<<< HEAD
     * @var Pluma\Routing\Router
=======
     * @var \Illuminate\Routing\Router
>>>>>>> dev
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
        $this->setRoles($request);

        $actions = $request->route()->getAction();
        $request->route()->setAction($actions + ['auth.roles' => $this->roles()]);

        // if menu is always viewable, proceed.
        if ($this->isAlwaysViewable($request->url())) {
            return $next($request);
        }

        if ($request->user()) {
            // if user is root, proceed.
            if ($request->user()->isRoot()) {
                return $next($request);
            }

            // if user has appropriate role, proceed.
            if ($request->user()->hasRole($this->roles)) {
                return $next($request);
            }
        }

        // Forbid
        return response()->view("Theme::errors.403", [], 403);
    }

    /**
     * Gets the route's roles.
     *
     * @param  Request $request
     * @return array
     */
    public function setRoles(Request $request)
    {
        if (App::runningInConsole()) {
            return [];
        }

        $this->setUserPermissions();

        $action = $request->route()->getAction();
        foreach ($this->permissions() as $permission) {
            if (isset($action['as']) && $action['as'] === $permission->name) {
                foreach ($permission->grants as $grants) {
                    foreach ($grants->roles as $role) {
                        $this->roles[] = $role->code;
                    }
                }
            }
        }
    }

    /**
     * Sets the User's Permissions.
     *
     */
    public function setUserPermissions()
    {
        if (isset(user()->roles)) {
            foreach (user()->roles as $role) {
                foreach ($role->grants as $grant) {
                    foreach ($grant->permissions as $permission) {
                        $this->permissions[] = $permission;
                    }
                }
            }
        }
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
     * Gets the roles array.
     *
     * @return array
     */
    protected function roles()
    {
        return $this->roles ? $this->roles : [];
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
