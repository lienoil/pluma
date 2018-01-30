<?php

namespace Course\Models;

use Bookmark\Support\Scopes\OnlyBookmarkedBy;
use Bookmark\Support\Traits\Bookmarkable;
use Category\Support\Relations\BelongsToCategory;
use Course\Support\Mutators\CourseMutator;
use Course\Support\Traits\BelongsToManyUsers;
use Course\Support\Traits\EnrolledUserMutator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Traits\HasManyContentsThroughLesson;
use Lesson\Support\Traits\HasManyLessons;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;
use Comment\Models\Comment;

class Course extends Model
{
    use BelongsToCategory, BelongsToUser, BelongsToManyUsers, CourseMutator, HasManyLessons,
        SoftDeletes, Bookmarkable, OnlyBookmarkedBy, EnrolledUserMutator,
        HasManyContentsThroughLesson;

    protected $with = ['lessons', 'user'];

    protected $appends = ['author', 'bookmarked', 'enrolled', 'created', 'excerpt', 'modified'];

    protected $searchables = ['title', 'code', 'slug', 'feature', 'body', 'created_at', 'updated_at'];

     //
    public function course()
    {
        return $this->morphMany('Comment', '`');
    }

    public function comments()
    {
        return $this->morphMany(\Comment\Models\Comment::class, 'commentable');
    }
}
