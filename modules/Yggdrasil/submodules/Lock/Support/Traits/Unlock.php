<?php

namespace Lock\Support\Traits;

trait Unlock
{
    /**
     * Check if resource is locked.
     *
     * @return boolean
     */
    public function isLocked()
    {
        return $this->unlocks()->where('user_id', user()->id)->count() === 0;
    }

    /**
     * Check if resource is locked.
     *
     * @return boolean
     */
    public function getLockedAttribute()
    {
        return $this->isLocked();
    }

    /**
     * Check if resource is locked.
     *
     * @return boolean
     */
    public function getUnlockedAttribute()
    {
        return ! $this->isLocked();
    }

    /**
     * Check if unlock is current
     *
     * @return boolean
     */
    public function getCurrentAttribute()
    {
        return $this->unlocks()->where('user_id', user()->id)->first() ? $this->unlocks()->where('user_id', user()->id)->first()->current : false;
        // return ($this->unlocks->isEmpty() ? '-1' : $this->unlocks->last()->id) === $this->id;
    }
}
