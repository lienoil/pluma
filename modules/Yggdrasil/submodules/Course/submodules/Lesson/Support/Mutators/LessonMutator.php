<?php

namespace Lesson\Support\Mutators;

use Course\Models\Status;
use Illuminate\Support\Facades\DB;

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
        return $this->contents->count() . ' ' . ($this->contents->count() > 1 ? __('Contents') : __('Content'));
    }

    /**
     * Gets the progress of user in percentage.
     *
     * @return int
     */
    public function getProgressAttribute()
    {
        return (float) number_format((float) (($this->completed * 100) / $this->contents->count()), 2);
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

        return DB::table('content_user')
            ->where('user_id', user()->id)
            ->where('course_id', $this->course->id)
            ->whereIn('content_id', $this->contents()->pluck('id')->toArray())
            ->where('status', 'completed')
            ->exists();
    }

    /**
     * Gets the progress of user in percentage
     *
     * @return string
     */
    public function getCurrentAttribute()
    {
        if (! isset(user()->id)) {
            return 0;
        }

        return DB::table('content_user')
            ->where('user_id', user()->id)
            ->where('course_id', $this->course->id)
            ->whereIn('content_id', $this->contents()->pluck('id')->toArray())
            ->where('status', 'current')
            ->count();
    }

    /**
     * Gets the progress of user in percentage.
     *
     * @return string
     */
    public function getLockedAttribute()
    {
        if (! isset(user()->id)) {
            return 0;
        }

        return DB::table('content_user')
            ->where('user_id', user()->id)
            ->where('course_id', $this->course->id)
            ->whereIn('content_id', $this->contents()->pluck('id')->toArray())
            ->where('status', 'pending')
            ->count();
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
