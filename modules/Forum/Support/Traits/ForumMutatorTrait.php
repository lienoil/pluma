<?php

namespace Forum\Support\Traits;

use Crowfeather\Traverser\Traverser;

trait ForumMutatorTrait
{
    /**
     * Gets the user's displayname.
     *
     * @return string
     */
    public function getAuthorAttribute()
    {
        return ! $this->user ?: $this->user->displayname;
    }
}
