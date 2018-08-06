<?php

namespace Content\Models;

use Comment\Support\Relations\MorphManyComments;
use Course\Support\Relations\BelongsToManyUsers;
use Library\Support\Traits\BelongsToLibrary;
use Pluma\Models\Model;

class Content extends Model
{

    use BelongsToLibrary,
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
