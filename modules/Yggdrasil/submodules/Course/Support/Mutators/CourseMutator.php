<?php

namespace Course\Support\Mutators;

use Course\Models\Course;
use Course\Models\User;

trait CourseMutator
{
    /**
     * Gets the user's display name.
     *
     * @return string
     */
    public function getAuthorAttribute()
    {
        return $this->user->displayname;
    }

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
