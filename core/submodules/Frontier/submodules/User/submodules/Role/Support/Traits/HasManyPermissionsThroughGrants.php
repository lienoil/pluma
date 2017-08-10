<?php

namespace Role\Support\Traits;

use Role\Models\Grant;
use Role\Models\Permission;

trait HasManyPermissionsThroughGrants
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
}
