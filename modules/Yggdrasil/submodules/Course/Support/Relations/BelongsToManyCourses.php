<?php

namespace Course\Support\Relations;

use Course\Models\Course;

trait BelongsToManyCourses
{
    /**
     * Get the courses that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class)
                    ->withPivot('dropped_at', 'status', 'enrolled_at');
    }
}
