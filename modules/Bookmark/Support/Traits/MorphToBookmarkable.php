<?php

namespace Bookmark\Support\Traits;

trait MorphToBookmarkable
{
    /**
     * Get all of the owning bookmarkable models.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function bookmarkable()
    {
        return $this->morphTo();
    }
}
