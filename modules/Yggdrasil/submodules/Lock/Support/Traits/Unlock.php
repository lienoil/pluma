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
        if (! $this->isLockable()) {
            return false;
        }

        return $this->unlocks()->where('user_id', user()->id)->count() === 0;
    }

    /**
     * Check if a column `lockable` is set to true.
     * A falsy `lockable` (lockable == 0) means users will have access to the resource
     * without unlocking.
     *
     * @return boolean
     */
    public function isLockable()
    {
        return isset($this->lockable) && (boolean) $this->lockable;
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
