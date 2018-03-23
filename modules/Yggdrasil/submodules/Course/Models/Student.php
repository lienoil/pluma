<?php

namespace Course\Models;

use Course\Models\Course;
use Course\Support\Relations\BelongsToManyCourses;
use Course\Support\Traits\CourseUserMutator;
use User\Models\User;

class Student extends User
{
    use CourseUserMutator;

    protected $table = 'users';

    /**
     * Get the courses that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function courses()
    {
        return $this->belongsToMany(
            Course::class,
            'course_user',
            'user_id'
        );
    }
}
