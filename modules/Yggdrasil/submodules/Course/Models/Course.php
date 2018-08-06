<?php

namespace Course\Models;

use Bookmark\Support\Relations\MorphManyBookmarks;
use Category\Support\Relations\BelongsToCategory;
use Comment\Support\Relations\MorphManyComments;
use Course\Controllers\Resources\EnrolledUserMutator;
use Course\Support\Mutators\CourseMutator;
use Course\Support\Relations\BelongsToManyUsers;
use Course\Support\Relations\HasManyLessons;
use Course\Support\Scopes\EnrolledToACourse;
use Form\Support\Relations\BelongsToManyForms;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\SlugOrFail;
use Submission\Support\Relations\HasManySubmissions;
use User\Support\Traits\BelongsToUser;

class Course extends Model
{
    use HasManyLessons,
        SoftDeletes,
        SlugOrFail,
        BelongsToCategory,
        BelongsToManyUsers, // Students of the Course (course_user)
        BelongsToUser, // Author of the Course (courses.user_id)
        MorphManyBookmarks,
        EnrolledToACourse,
        EnrolledUserMutator,
        BelongsToManyForms,
        HasManyLessons,
        MorphManyComments,
        HasManySubmissions,
        SoftDeletes;

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
