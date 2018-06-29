<?php

namespace Course\Support\Relations;

use Course\Models\Lesson;

trait HasManyLessons
{
    /**
     * Gets the resources that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Gets the resources that belongs to this resource.
     * Will only retrieve root nodes.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function children()
    {
        return $this->hasMany(Lesson::class)->tree();
    }
}
