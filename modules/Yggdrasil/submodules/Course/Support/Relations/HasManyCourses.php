<?php

namespace Course\Support\Relations;

use Course\Models\Course;

trait HasManyCourses
{
    /**
     * Gets the resource that owns courses.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
