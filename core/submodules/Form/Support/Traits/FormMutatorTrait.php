<?php

namespace Form\Support\Traits;

use Crowfeather\Traverser\Traverser;

trait FormMutatorTrait
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
