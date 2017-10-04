<?php

namespace Lock\Support\Traits;

use Lock\Models\Unlock;

trait MorphManyUnlocks
{
    /**
     * Get all of the resource's unlocked content.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function unlocks()
    {
        return $this->morphMany(Unlock::class, 'unlockable');
    }
}
