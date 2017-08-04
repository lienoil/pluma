<?php

namespace Role\Support\Traits;

use Role\Models\Permission;

trait BelongsToManyPermissions
{
    /**
     * Gets all resources associated
     * with this model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
