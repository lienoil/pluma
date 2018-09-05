<?php

namespace Course\Support\Accessor;

trait CourseUserAccessor
{
    public function getCurrentAttribute()
    {
        return $this->courses()->find($course_id)->current;
    }

    /**
     * Gets the user's displayname.
     *
     * @return string
     */
    public function getAuthorAttribute()
    {
        return ! $this->user ?: $this->user->displayname;
    }

    public function getEnrolledAttribute()
    {
        return 1;
    }
}
