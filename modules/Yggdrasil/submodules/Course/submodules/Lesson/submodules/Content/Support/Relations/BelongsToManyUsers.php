<?php

namespace Content\Support\Relations;

use Course\Models\User;

trait BelongsToManyUsers
{
    /**
     * Gets all User resources associated
     * with this model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function user()
    {
        return $this->belongsToMany(User::class)->withPivot('status');
    }
}
