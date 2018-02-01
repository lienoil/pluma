<?php

namespace Course\Models;

use Bookmark\Support\Scopes\OnlyBookmarkedBy;
use Bookmark\Support\Traits\Bookmarkable;
use Category\Support\Relations\BelongsToCategory;
use Course\Support\Mutators\CourseMutator;
use Course\Support\Relations\BelongsToManyUsers;
use Course\Support\Traits\EnrolledUserMutator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Traits\HasManyContentsThroughLesson;
use Lesson\Support\Traits\HasManyLessons;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Course extends Model
{
    use BelongsToCategory,
        BelongsToManyUsers,
        BelongsToUser,
        Bookmarkable,
        CourseMutator,
        EnrolledUserMutator,
        HasManyContentsThroughLesson,
        HasManyLessons,
        OnlyBookmarkedBy,
        SoftDeletes;

    protected $with = ['lessons', 'user', 'category'];

    protected $appends = [
        'author',
        'bookmarked',
        'created',
        'enrolled',
        'excerpt',
        'modified',
    ];

    protected $searchables = [
        'body',
        'code',
        'created_at',
        'feature',
        'slug',
        'title',
        'updated_at',
    ];
}
