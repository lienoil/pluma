<?php

namespace Role\Support\Traits;

use Role\Models\Role;

trait BelongsToManyRoles
{
    /**
     * Root roles.
     *
     * @var array
     */
    protected $rootroles = [
        'root',
        'dev',
        'superadmin',
        'super-administrator',
        'super-admin'
    ];

    /**
     * The Code column's name
     * used to check for role's code.
     *
     * @var string
     */
    protected $codeColumn = 'code';

    /**
     * Gets all Role resources associated
     * with this model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Check if resource is root.
     *
     * @return boolean
     */
    public function isRoot()
    {
        foreach ($this->roles as $role) {
            if (in_array($role->{$this->codeColumn}, $this->rootroles())) {
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
    protected function rootroles()
    {
        return $this->rootroles;
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
        return $this->roles()->where($this->codeColumn, $role)->orWhere('name', $role)->exists();
    }

    /**
     * Sets the rootroles.
     *
     * @param array $rootroles
     */
    public function setRootroles($rootroles = [])
    {
        $this->rootroles = array_merge($this->rootroles, $rootroles);
    }

    /**
     * Checks permissions through grants.
     *
     * @param  string  $permission
     * @return boolean
     */
    public function isPermittedTo($permission)
    {
        foreach ($this->roles as $role) {
            foreach ($role->grants as $grant) {
                if ($grant->permissions && $grant->permissions()->where('code', $permission)->exists()) {
                    return true;
                }
            }
        }

        return false;
    }
}
