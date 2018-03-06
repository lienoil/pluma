<?php

namespace Course\Support\Relations;

use Course\Models\User;

trait BelongsToManyUsers
{
    /**
     * Gets all User resources associated
     * with this model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('dropped_at', 'enrolled_at');
    }
}
