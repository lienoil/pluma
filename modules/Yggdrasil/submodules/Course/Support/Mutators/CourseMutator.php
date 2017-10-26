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

    public function getPercentageAttribute()
    {
        // echo "<pre>";
        // $total = $this->lessons->count();
        // $completed = $this->lessons->map(function ($lesson) {
        //     return $lesson->lockable;
        // });

        // dd($completed);

        return 100;
    }

    /**
     * Check if currently logged in user is enrolled
     * to this course.
     *
     * @return boolean
     */
    public function getEnrolledAttribute()
    {
        return \Course\Models\User::find(user()->id)->courses()->where('id', $this->id)->exists();
    }

    /**
     * Check if this course is bookmarked by user.
     *
     * @return boolean
     */
    public function getBookmarkedAttribute()
    {
        return $this->bookmarks()->where('user_id', user()->id)->exists();
    }
}
