<?php

namespace Content\Support\Traits;

use Content\Models\Content;
use Course\Models\User as Student;

trait HasManyContents
{
    /**
     * Get the contents for the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function contents()
    {
        return $this->hasMany(Content::class)->orderBy('sort', 'ASC');
    }

    /**
     * Gets the mutated pivot columns.
     *
     * @return array
     */
    public function getPlaylistAttribute()
    {
        $student = Student::find(user()->id);
        $contents = $student->contents;
        $playlist = [];

        foreach ($contents as $content) {
            $playlist[] = $content->pivot;
        }

        return $playlist;
    }
}
