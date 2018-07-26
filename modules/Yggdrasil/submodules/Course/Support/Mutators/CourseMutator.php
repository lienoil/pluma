<?php

namespace Course\Support\Mutators;

use User\Models\Course;
use User\Models\User;

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
            ($this->lessons->count() > 1 ? __('Lessons')
                : __('Lesson'));
    }

    /**
     * Check if this course is bookmarked by user.
     *
     * @return boolean
     */
    public function getBookmarkedAttribute()
    {
        return isset(user()->id)
                ? $this->bookmarks()->where('user_id',
                    user()->id)->exists()
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

    /**
     * Get the url of the content.
     *
     * @return string
     */
    public function getFirstContentAttribute()
    {
        return $this->contents()->first()->url;
    }

    public function getLatestAttribute()
    {
        $user = User::find(user()->id);

        if ($user->contents()->wherePivot('course_id', $this->id)->where('status', 'current')->exists()) {
            return $user->contents()->wherePivot('course_id', $this->id)->where('status', 'current')->first();
        }

        return $user->contents->first() ??
            null;
    }

    /**
     * Alias for the course_user pivot.
     *
     * @return  float
     */
    public function getProgressAttribute()
    {
        $user = $this->users()->find(user()->id);
        $contents = $user->contents()->wherePivot('course_id', $this->id)->get();
        $completed = $user->contents()->wherePivot('status', 'completed')
                          ->orWherePivot('status', 'done')
                          ->count();

        $result = ($completed/$contents->count()) * 100;
        return (float) number_format((float) $result, 2);
    }

    /**
     * Check if course has been completed.
     *
     * @return boolean
     */
    public function getCompletedAttribute()
    {

        return (float) $this->progress == (float) number_format((float) 100, 2);

    }
}
