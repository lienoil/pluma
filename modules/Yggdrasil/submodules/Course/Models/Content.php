<?php

namespace Content\Models;

use Pluma\Models\Model;

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

    protected $searchables = ['title', 'body', 'created_at', 'updated_at'];
}
