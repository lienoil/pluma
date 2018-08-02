<?php

namespace Course\Controllers\Resources;

use Course\Models\User;

trait EnrolledUserMutator
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
     * @return [type] [description]
     */
    public function getStudentAttribute()
    {
        return $this->users()->where('users.id', user()->id)->first();
    }

    /**
     * Check if currently logged in user is enrolled
     * to this course.
     *
     * @return boolean
     */
    public function getEnrolledAttribute()
    {
        return isset(user()->id)
                ? $this->users()->where('user_id', user()->id)->whereNull('dropped_at')->exists()
                : false;
    }

}
