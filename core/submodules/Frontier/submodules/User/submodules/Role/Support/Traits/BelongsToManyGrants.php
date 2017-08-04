<?php

namespace Role\Support\Traits;

use Role\Models\Grant;

trait BelongsToManyGrants
{
    /**
     * Gets all Grant resources associated
     * with this model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function grants()
    {
        return $this->belongsToMany(Grant::class);
    }
}
