<?php

namespace Course\Support\Accessors;

use Course\Models\User;

trait EnrolledUserAccessor
{
    /**
     * Alias for BelongsToManyUsers.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getStudentsAttribute()
    {
        return $this->users;
    }

    /**
     * Get the student currently requesting the course.
     * (Currently logged in)
     *
     * @return
     */
    public function getStudentAttribute()
    {
        return $this->users()->where('users.id', user()->id)->first();
    }

    public function getEnrolledAttribute()
    {
        return isset(user()->id)
                ? $this->users()->where('user_id', user()->id)->whereNull('dropped_at')->exists()
                : false;
    }
}
