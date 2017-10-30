<?php

namespace Course\Support\Traits;

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
        return \Course\Models\User::find(user()->id)->courses()->where('courses.id', $this->id)->exists();
    }

    /**
     * Alias for the course_user pivot.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getProgressAttribute()
    {
        return $this->student ? $this->student->pivot : null;
    }
}
