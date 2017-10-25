<?php

namespace Pluma\Policies;

use Forum\Models\Forum;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPolicy
{
    public function before($user, $ability)
    {
        if ( $user->isRoot() ) return true;
    }

    /**
     * Determine if the given user can be created by the user.
     *
     * @param  \Pluma\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine if the given user can be updated by the user.
     *
     * @param  \Pluma\Models\User $user
     * @param  \Pluma\Models\Forum $resource
     * @return bool
     */
    public function update(User $user, Forum $resource)
    {
        return $user->id === $resource->user->id;
    }

    /**
     * Determine if the given user can be deleted by the user.
     *
     * @param  \Pluma\Models\User $user
     * @param  \Pluma\Models\Forum $resource
     * @return bool
     */
    public function delete(User $user, Forum $resource)
    {
        return $user->id !== $rsource->id;
    }
}
