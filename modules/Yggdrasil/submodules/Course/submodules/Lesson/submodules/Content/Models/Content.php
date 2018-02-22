<?php

namespace Content\Models;

<<<<<<< HEAD
=======
use Comment\Support\Relations\MorphManyComments;
>>>>>>> dev
use Content\Support\Traits\ContentMutator;
use Course\Support\Traits\Status;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Traits\BelongsToLesson;
use Lesson\Support\Traits\HasCourseThroughLesson;
use Library\Support\Traits\BelongsToLibrary;
use Pluma\Models\Model;
<<<<<<< HEAD
use Comment\Support\Relations\MorphManyComments;
=======
>>>>>>> dev

class Content extends Model
{
    use BelongsToLesson,
        HasCourseThroughLesson,
        BelongsToLibrary,
        ContentMutator,
        MorphManyComments,
        Status;

    protected $with = ['library', 'lesson'];

    protected $appends = [
        'current', 'locked', 'completed', 'incomplete',
        'url', 'interactive'
    ];

    protected $searchables = ['title', 'body', 'created_at', 'updated_at'];
}
