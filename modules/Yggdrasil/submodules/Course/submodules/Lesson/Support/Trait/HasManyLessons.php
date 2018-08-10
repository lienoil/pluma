<?php

namespace Lesson\Support\Traits;

use Course\Models\Lesson;

trait HasManyLessons
{
    /**
     * Get the lessons for the resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('sort', 'ASC');
    }
}
