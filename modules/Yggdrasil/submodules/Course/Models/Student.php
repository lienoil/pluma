<?php

namespace Course\Models;

use Course\Controllers\Resources\CourseUserMutator;
use Course\Models\Course;
use User\Models\User;
use Course\Support\Relations\BelongsToManyCourses;

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
        // return $this->belongsToMany(
        //     Course::class,
        //     'courses',
        //     'user_id'
        // );
    }
}
