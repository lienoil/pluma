<?php

namespace Course\Models;

use Bookmark\Support\Relations\MorphManyBookmarks;
use Bookmark\Support\Traits\Bookmarkable;
use Category\Support\Relations\BelongsToCategory;
use Comment\Support\Relations\MorphManyComments;
use Course\Support\Mutators\CourseMutator;
use Course\Support\Relations\BelongsToManyUsers;
use Course\Support\Scopes\EnrolledToACourse;
use Course\Support\Scopes\OnlyBookmarkedByScope;
use Course\Support\Traits\CourseCommitTrait;
use Course\Support\Traits\EnrolledUserMutator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Traits\HasManyContentsThroughLesson;
use Lesson\Support\Traits\HasManyLessons;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Course extends Model
{
    use BelongsToCategory,
        BelongsToManyUsers, // Students of the Course (course_user)
        BelongsToUser, // Author of the Course (courses.user_id)
        MorphManyBookmarks,
        CourseCommitTrait,
        CourseMutator,
        EnrolledToACourse,
        EnrolledUserMutator,
        HasManyContentsThroughLesson,
        HasManyLessons,
        MorphManyComments,
        OnlyBookmarkedByScope,
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
        'category_id',
        'code',
        'created_at',
        'feature',
        'slug',
        'title',
        'updated_at',
        'enrolled_at',
        'dropped_at',
    ];
}
