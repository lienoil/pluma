<?php

namespace Submission\Support\Traits;

use Crowfeather\Traverser\Traverser;

trait SubmissionMutatorTrait
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

    public function getResultedAttribute()
    {
        return unserialize($this->results);
    }
}
