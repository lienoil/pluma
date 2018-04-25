<?php

namespace Role\Support\Relations;

use Role\Models\Role;

trait BelongsToManyRoles
{
    /**
     * Gets all Role resources associated
     * with this model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
