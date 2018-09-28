<?php

namespace Lesson\Support\Traits;

use Content\Models\Content;
use Course\Models\Lesson;

trait HasManyContentsThroughLesson
{
    /**
     * Get the lessons for the resource.
     *
     * @return  \Illuminatte\Database\Eloquent\Model
     */
    public function contents()
    {
        return $this->hasManyThrough(Content::class, Lesson::class)
            ->orderBy('lessons.sort', 'ASC')
            ->orderBy('contents.sort', 'ASC');
    }
}
