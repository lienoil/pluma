<?php

namespace Lock\Support\Traits;

trait MorphToUnlock
{
    /**
     * Get all of the owning unlockable models.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function unlockable()
    {
        return $this->morphTo();
    }
}
