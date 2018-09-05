<?php

namespace Forum\Support\Accessors;

use Crowfeather\Traverser\Traverser;

trait ForumAccessorTrait
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
