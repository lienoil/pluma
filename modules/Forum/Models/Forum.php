<?php

namespace Forum\Models;

use Category\Support\Relations\BelongsToCategory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Forum\Support\Traits\ForumMutatorTrait;
use User\Support\Traits\BelongsToUser;
use Comment\Models\Comment;

class Forum extends Model
{
    use SoftDeletes, BelongsToUser, ForumMutatorTrait, BelongsToCategory;

    protected $with = ['category'];

    protected $appends = ['author', 'created', 'modified', 'removed'];

    protected $searchables = ['name', 'code', 'body', 'created_at', 'updated_at'];

    //
    public function forum()
    {
        return $this->morphMany('Comment', 'commentable');
    }

    public function comments()
    {
        return $this->morphMany(\Comment\Models\Comment::class, 'commentable');
    }
}
