<?php

namespace Course\Models;

use Bookmark\Support\Scopes\OnlyBookmarkedBy;
use Bookmark\Support\Traits\Bookmarkable;
use Category\Support\Traits\BelongsToCategory;
use Course\Support\Mutators\CourseMutator;
use Course\Support\Traits\BelongsToManyUsers;
use Course\Support\Traits\EnrolledUserMutator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Traits\HasManyContentsThroughLesson;
use Lesson\Support\Traits\HasManyLessons;
use Lock\Support\Traits\MorphManyUnlocks;
use Lock\Support\Traits\Unlock;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Course extends Model
{
    use BelongsToCategory, BelongsToUser, BelongsToManyUsers, CourseMutator, HasManyLessons,
        MorphManyUnlocks, SoftDeletes, Unlock, Bookmarkable, OnlyBookmarkedBy, EnrolledUserMutator,
        HasManyContentsThroughLesson;

    protected $with = ['lessons', 'user', 'users', 'category'];

    protected $appends = ['author', 'bookmarked', 'progress', 'enrolled', 'created', 'excerpt', 'modified', 'locked', 'unlocked'];

    protected $searchables = ['title', 'code', 'slug', 'feature', 'body', 'created_at', 'updated_at'];
}
