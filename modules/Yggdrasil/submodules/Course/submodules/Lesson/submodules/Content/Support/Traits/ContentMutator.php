<?php

namespace Content\Support\Traits;

trait ContentMutator
{
    /**
     * Route show shortcut.
     *
     * @return \Illuminate\Routing\Route
     */
    public function getUrlAttribute()
    {
        return route('contents.show', [$this->lesson->course->slug, $this->lesson->id, $this->id]);
    }

    /**
     * Alias for unlock.
     *
     * @return boolean
     */
    public function getCompletedAttribute()
    {
        return $this->unlocked;
    }
}
