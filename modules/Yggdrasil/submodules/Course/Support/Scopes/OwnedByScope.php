<?php

namespace Course\Support\Scopes;

use Illuminate\Database\Eloquent\Builder;
use User\Models\User;

trait OwnedByScope
{

    /**
     * Retrieve all resources owned by given user model.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \User\Models\User    $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeOwnedBy(Builder $builder, User $user)
    {
        return $builder->where();
    }
}
