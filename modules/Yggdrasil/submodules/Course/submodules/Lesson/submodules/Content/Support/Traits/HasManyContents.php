<?php

namespace Content\Support\Traits;

use Content\Models\Content;

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
        $pivots = $this->course->users()->where('user_id', user()->id)->get();
        $playlist = [];

        foreach ($pivots as $pivot) {
            $playlist[] = $pivot->pivot;
        }

        return $playlist;
    }
}
