<?php

namespace Content\Models;

use Comment\Support\Relations\MorphManyComments;
use Content\Support\Relations\BelongsToManyUsers;
use Content\Support\Relations\MorphToContentable;
use Content\Support\Traits\ContentMutator;
use Lesson\Support\Traits\BelongsToLesson;
use Lesson\Support\Traits\HasCourseThroughLesson;
use Library\Support\Traits\BelongsToLibrary;

class Content extends Model
{
    use BelongsToLesson,
        HasCourseThroughLesson,
        BelongsToLibrary,
        ContentMutator,
        BelongsToManyUsers,
        MorphToContentable,
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

    protected $searchables = ['title', 'body', 'created_at', 'updated_at']
}
