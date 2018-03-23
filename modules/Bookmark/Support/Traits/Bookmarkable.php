<?php

namespace Bookmark\Support\Traits;

use Bookmark\Models\Bookmark;

trait Bookmarkable
{
    /**
     * Get all of the resource's bookmarks.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    /**
     * Check if this course is bookmarked by user.
     *
     * @return boolean
     */
    public function getBookmarkedAttribute()
    {
        return isset(user()->id)
                ? $this->bookmarks()->where('user_id', user()->id)->exists()
                : false;
    }
}
