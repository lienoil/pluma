<?php

namespace Course\Support\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


trait EnrolledToACourse
{
    /**
     * Gets the students NOT Enrolled at the current resource.
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param  int $course_id
     * @return \Illuminate\Database\Capsule\Eloquent
     */
    public function scopeNotEnrolledToCourse(Builder $builder, $course_id)
    {
        $users = [];
        $courses = DB::table('course')
                     ->where('id', $course_id)
                     ->get();

        foreach ($courses as $course) {
            if (is_null($course->dropped_at)) {
                $users[] = $course->user_id;
            }
        }

        return $builder->whereNotIn('id', $users);
    }
}
