<?php

namespace Lesson\Support\Mutators;

use Course\Models\Status;

trait LessonMutator
{
    /**
     * Gets the current order of the resource.
     *
     * @return integer
     */
    public function getOrderAttribute()
    {
        return (int) $this->sort+1;
    }

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

    /**
     * Gets the progress of user in percentage.
     *
     * @return int
     */
    public function getProgressAttribute()
    {
        $user = \Course\Models\User::find(user()->id);

        return (float) number_format((float)(($this->completed * 100) / $user->contents->count()), 2);
    }

    /**
     * Gets the progress of user in percentage.
     *
     * @return string
     */
    public function getCompletedAttribute()
    {
        if (! isset(user()->id)) {
            return 0;
        }

        $user = \Course\Models\User::find(user()->id);
        $count = $user->contents()->where('status', 'done')->where('course_id', $this->course->id)->count();
        // dd($count);
        // $count = Status::where('user_id', user()->id)
        //     ->where('course_id', $this->course->id)
        //     ->whereIn('content_id', $this->contents()->pluck('id')->toArray())
        //     ->where('status', 'completed')
        //     ->count();

        return $count;
    }

    /**
     * Gets the dialog model.
     *
     * @return boolean
     */
    public function getDialogAttribute()
    {
        return false;
    }
}
