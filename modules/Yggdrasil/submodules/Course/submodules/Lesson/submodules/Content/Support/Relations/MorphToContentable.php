<?php

namespace Content\Support\Relations;

trait MorphToContentable
{
    /**
     * Get all of the owning bookmarkable models.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function contentable()
    {
        return $this->morphTo();
    }
}
