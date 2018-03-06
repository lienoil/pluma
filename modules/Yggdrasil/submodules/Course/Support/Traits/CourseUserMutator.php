<?php

namespace Course\Support\Traits;

use Carbon\Carbon;

trait CourseUserMutator
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
     * @return Date|string
     */
    public function getEnrolledAttribute()
    {
<<<<<<< HEAD
        return Carbon::createFromTimeStamp(strtotime($this->enrolled_at))->diffForHumans(); //date(config('settings.date_format', 'F d, Y \(h:iA\)'), strtotime($this->created_at));
=======
        return 1; //Carbon::createFromTimeStamp(strtotime($this->pivot->enrolled_at))->diffForHumans();
>>>>>>> master
    }
}
