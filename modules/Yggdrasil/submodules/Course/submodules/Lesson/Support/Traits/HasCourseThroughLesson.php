<?php

namespace Lesson\Support\Traits;

trait HasCourseThroughLesson
{
    /**
     * Shorthand of Lesson > Course Relationship.
     * Access the course through lesson.
     *
     * @return \Illuminate\Database\ELoquent\Model
     */
    public function getCourseAttribute()
    {
        return $this->lesson->course;
    }
}
