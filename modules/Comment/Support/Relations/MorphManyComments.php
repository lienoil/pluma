<?php

namespace Comment\Support\Relations;

use Comment\Models\Comment;

trait MorphManyComments
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
