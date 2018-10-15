<?php

namespace Course\Support\Accessors;

use Carbon\Carbon;

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

    /**
     * Get the pretty date of the created_at column.
     *
     * @return Date/string
     */
    public function getEnrolledAttribute()
    {
        return 1;
    }
}
