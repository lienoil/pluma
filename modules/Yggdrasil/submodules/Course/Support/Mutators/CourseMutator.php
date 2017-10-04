<?php

namespace Course\Support\Mutators;

trait CourseMutator
{
    /**
     * Get the lesson count
     *
     * @return string
     */
    public function getLessonsCountAttribute()
    {
        return $this->lessons->count() . ' ' .
            ($this->lessons->count() > 1 ? __('Lessons') : __('Lesson'));
    }
}
