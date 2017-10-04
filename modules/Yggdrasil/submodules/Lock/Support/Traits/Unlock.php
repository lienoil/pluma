<?php

namespace Lock\Support\Traits;

trait Unlock
{
    public function isLocked()
    {
        return $this->unlocks()->count() === 0;
    }
}
