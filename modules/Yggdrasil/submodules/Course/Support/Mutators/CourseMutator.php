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
}
