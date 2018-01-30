<?php

namespace Forum\Models;

use Category\Support\Relations\BelongsToCategory;
use Comment\Models\Comment;
use Comment\Support\Relations\MorphManyComments;
use Forum\Support\Traits\ForumMutatorTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Forum extends Model
{
    use SoftDeletes, BelongsToUser, ForumMutatorTrait, BelongsToCategory, MorphManyComments;

    protected $with = ['category'];

    protected $appends = ['author', 'created', 'excerpt', 'modified', 'removed'];

    protected $searchables = ['name', 'code', 'body', 'category_id', 'created_at', 'updated_at'];
}
