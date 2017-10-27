<?php

namespace Bookmark\Support\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait OnlyBookmarkedBy
{
    /**
     * Gets all resources that are bookmarked.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeOnlyBookmarkedBy(Builder $builder, $user_id)
    {
        return $builder->whereHas('bookmarks', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        });
    }
}
