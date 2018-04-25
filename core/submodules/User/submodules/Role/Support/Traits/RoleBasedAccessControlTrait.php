<?php

namespace Role\Support\Traits;

use Role\Models\Role;

trait RoleBasedAccessControlTrait
{
    /**
     * Keywords listed in this array will be excluded from role checking.
     * All roles listed here will have unrestricted access to the application.
     *
     * @var array
     */
    protected $rootRoles = [
        'root',
        'dev',
        'superadmin',
        'super-administrator',
        'super-admin',
    ];

    /**
     * The column's key name used to check for a role's given code.
     *
     * @var string
     */
    protected $columnKey = 'code';

    /**
     * Check if a user's role is root.
     *
     * @return boolean
     */
    public function isRoot()
    {
        foreach ($this->roles as $role) {
            if (in_array($role->{$this->columnKey}, $this->rootRoles())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gets the root roles.
     *
     * @return array
     */
    protected function rootRoles()
    {
        return array_merge($this->rootRoles, config('auth.roles', []));
    }

    /**
     * Check if resource has role.
     *
     * @param  mixed|string|array  $roles
     * @param  boolean $checkIfRoot
     * @return boolean
     */
    public function hasRole($roles, $checkIfRoot = true)
    {
        // If root, allow.
        if ($checkIfRoot && $this->isRoot()) {
            return true;
        }

        // if $roles is NULL, skip.
        if (! $roles) {
            return false;
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->has(trim($role))) {
                    return true;
                }
            }
        } else {
            if ($this->has(trim($roles))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Checks if resource has the specified parameter.
     *
     * @param  string  $role
     * @return boolean
     */
    private function has($role)
    {
        return $this->roles()->where($this->columnKey, $role)->orWhere('name', $role)->exists();
    }

    /**
     * Sets the rootRoles.
     *
     * @param array $rootRoles
     */
    public function setRootroles($rootRoles = [])
    {
        $this->rootRoles = array_merge($this->rootRoles, $rootRoles);
    }

    // /**
    //  * Check if user is permitted to executed the given action.
    //  *
    //  * @param  string  $action
    //  * @return boolean
    //  */
    // public function isPermittedTo($action)
    // {
    //     foreach ($this->roles as $role) {
    //         foreach ($role->permissions as $permission) {
    //             if ($permission->where('code', $action)->exists()) {
    //                 return true;
    //             }
    //         }
    //     }

    //     return false;
    // }

    // /**
    //  * [permissions description]
    //  * @return [type] [description]
    //  */
    // public function permissions()
    // {
    //     foreach ($this->roles as $role) {
    //         $this->permissions[] = $role->permissions;
    //     }

    //     return $this->permissions;
    // }
}
