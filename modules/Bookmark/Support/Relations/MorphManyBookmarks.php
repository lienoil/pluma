<?php

namespace Bookmark\Support\Relations;

use Bookmark\Models\Bookmark;

trait MorphManyBookmarks
{
    /**
     * The column name prefix.
     *
     * @var string
     */
    protected $bookmarkable = 'bookmarkable';

    /**
     * Morph to many bookmarks.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, $this->bookmarkable);
    }
}
