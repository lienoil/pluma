<?php

namespace Lesson\Support\Mutators;

trait LessonMutator
{
    /**
     * Get the contents count
     *
     * @return string
     */
    public function getContentsCountAttribute()
    {
        return $this->contents->count() . ' ' .
            ($this->contents->count() > 1 ? __('Contents') : __('Content'));
    }
}
