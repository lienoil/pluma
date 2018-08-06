<?php

namespace Lesson\Models;

use Course\Support\Relations\BelongsToCourse;
use Lesson\Support\Mutators\LessonMutator;
use Pluma\Models\Model;

class Lesson extends Model
{
    use BelongsToCourse, HasManyContents, BelongsToAssignment, LessonMutator;

    protected $with = [];

    protected $appends = [];

    protected $searchables = ['created_at', 'updated_at'];
}
