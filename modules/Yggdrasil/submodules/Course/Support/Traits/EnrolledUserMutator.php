<?php

namespace Course\Support\Traits;

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

    public function getRequestedAttribute()
    {
        return isset(user()->id)
                ? $this->users()->where('user_id', user()->id)->where('enrolled_at', null)->whereNull('dropped_at')->exists()
                : false;
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
                ? $this->users()->where('user_id', user()->id)->whereNotNull('enrolled_at')->whereNull('dropped_at')->exists()
                : false;
    }

    /**
     * Alias for the course_user pivot.
     *
     * @return float
     */
    public function getProgressAttribute()
    {
        if (is_null(user())) {
            return 0;
        }

        $count = \Course\Models\Status::where('user_id', (user()->id ?? null))
            ->where('course_id', $this->id)
            ->where('status', 'completed')
            ->count();

        return (float) number_format((float)(($count * 100) / $this->contents->count()), 2);
        // return $this->student ? $this->student->pivot : null;
    }
}
