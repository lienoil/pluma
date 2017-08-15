<?php

namespace Role\Support\Traits;

use Role\Models\Grant;
use Role\Models\Permission;

trait BelongsToManyPermissionsThroughRoles
{
    /**
     * Gets all Grant resources associated
     * with this model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
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
                if ($grant->permissions()->where('code', $permission)->exists()) {
                    return true;
                }
            }
        }

        return false;
    }
}
