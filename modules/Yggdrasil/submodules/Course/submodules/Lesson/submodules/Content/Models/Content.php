<?php

namespace Content\Models;

use Comment\Support\Relations\MorphManyComments;
use Content\Support\Relations\BelongsToManyUsers;
use Content\Support\Traits\ContentMutator;
use Course\Support\Traits\Status;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Traits\BelongsToLesson;
use Lesson\Support\Traits\HasCourseThroughLesson;
use Library\Support\Traits\BelongsToLibrary;
use Pluma\Models\Model;

class Content extends Model
{
    use BelongsToLesson,
        HasCourseThroughLesson,
        BelongsToLibrary,
        ContentMutator,
        BelongsToManyUsers,
        MorphManyComments;

    protected $with = ['library'];

    protected $appends = [
        'active',
        'completed',
        'current',
        'incomplete',
        'interactive',
        'locked',
        'url',
    ];

    protected $searchables = ['title', 'body', 'created_at', 'updated_at'];
}
