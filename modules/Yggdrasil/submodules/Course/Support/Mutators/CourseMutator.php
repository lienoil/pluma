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
        return $this->user;
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

    /**
     * Check if this course is bookmarked by user.
     *
     * @return boolean
     */
    public function getBookmarkedAttribute()
    {
        return isset(user()->id)
                ? $this->bookmarks()->where('user_id', user()->id)->exists()
                : false;
    }

    /**
     * Get the url of the course.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('courses.single', $this->slug);
    }
}
