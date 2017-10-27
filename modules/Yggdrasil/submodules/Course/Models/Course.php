<?php

namespace Course\Models;

use Bookmark\Support\Scopes\OnlyBookmarkedBy;
use Bookmark\Support\Traits\Bookmarkable;
use Category\Support\Traits\BelongsToCategory;
use Course\Support\Mutators\CourseMutator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Traits\HasManyLessons;
use Lock\Support\Traits\MorphManyUnlocks;
use Lock\Support\Traits\Unlock;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Course extends Model
{
    use BelongsToCategory, BelongsToUser, CourseMutator, HasManyLessons,
        MorphManyUnlocks, SoftDeletes, Unlock, Bookmarkable, OnlyBookmarkedBy;

    protected $with = ['lessons', 'user', 'category'];

    protected $appends = ['percentage', 'bookmarked', 'enrolled', 'created', 'excerpt', 'modified', 'locked', 'unlocked', 'current'];

    protected $searchables = ['title', 'code', 'slug', 'feature', 'body', 'created_at', 'updated_at'];
}
