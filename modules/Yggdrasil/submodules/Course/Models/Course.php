<?php

namespace Course\Models;

use Bookmark\Support\Relations\MorphManyBookmarks;
use Bookmark\Support\Traits\Bookmarkable;
use Category\Support\Relations\BelongsToCategory;
use Comment\Support\Relations\MorphManyComments;
use Course\Support\Accessors\CourseAccessor;
use Course\Support\Accessors\EnrolledUserAccessor;
use Course\Support\Relations\BelongsToManyUsers;
use Course\Support\Scopes\EnrolledToACourse;
use Course\Support\Scopes\OnlyBookmarkedByScope;
use Course\Support\Traits\CourseCommitTrait;
use Form\Support\Relations\BelongsToManyForms;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Traits\HasManyContentsThroughLesson;
use Lesson\Support\Traits\HasManyLessons;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\SlugOrFail;
use Submission\Support\Relations\HasManySubmissions;
use User\Support\Traits\BelongsToUser;


class Course extends Model
{
    use BelongsToCategory,
        BelongsToManyUsers, // Students of the Course (course_user)
        BelongsToUser, // Author of the Course (courses.user_id)
        MorphManyBookmarks,
        CourseCommitTrait,
        CourseAccessor,
        EnrolledToACourse,
        EnrolledUserAccessor,
        BelongsToManyForms,
        HasManyContentsThroughLesson,
        HasManyLessons,
        MorphManyComments,
        OnlyBookmarkedByScope,
        HasManySubmissions,
        SoftDeletes,
        SlugOrFail;

    protected $with = [];

    protected $appends = [
        'author',
        'bookmarked',
        'created',
        'excerpt',
        'modified',
        'enrolled',
        'first_content',
    ];
    protected $searchables = [
        'title',
        'slug',
        'code',
        'feature',
        'backdrop',
        'body',
        'created_at',
        'updated_at'
    ];
}
