<?php

namespace Course\Resources;

use Course\Models\Status;

trait Status
{
    /**
     * Belongs to a status.
     *
     * @return \Course\Models\Status
     */
    public function status()
    {
        return $this->hasOne(Model::class);
    }

    /**
     * Get the status of the course.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getStateAttribute()
    {
        if (! is_null(user())) {
            return false;
        }

        $state = $this->status()->where('user_id', user()->id)
                                ->where('course_id', $this->course->id)
                                ->where('content_id', $this->id)->first();
        return $state ? $state->status : null;
    }

    /**
     * Complete state.
     *
     * @return boolean
     */
    public function getCompletedAttribute()
    {
        return $this->state === "completed";
    }

    /**
     * Incomplete state.
     *
     * @return boolean
     */
    public function getIncompletedAttribute()
    {
        return $this->state === "note attempted" || $this->state === "current";
    }

    /**
     * Null or non-existant status.
     *
     * @return boolean
     */
    public function getLockedAttribute()
    {
        return $this->state === null;
    }
}
