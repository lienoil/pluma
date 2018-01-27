<?php

namespace Comment\Support\Relations;

use Comment\Models\Comment;

trait HasManyComments
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
