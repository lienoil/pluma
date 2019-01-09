<?php

namespace Role\Support\Accessors;

use Role\Models\Permission;

trait RoleAccessor
{
    /**
     * Retrieve the permissions count for the resource.
     *
     * @return int
     */
    public function getPermissionCountAttribute()
    {
        return $this->permissions->count().' of '.Permission::count();
    }
}
