<?php

namespace Lesson\Models;

use Assignment\Support\Traits\BelongsToAssignment;
use Course\Support\Relations\BelongsToCourse;
use Pluma\Models\Model;

class Lesson extends Model
{

    use BelongsToCourse, HasManyContents, BelongsToAssignment, LessonMutator;

    protected $with = [];

    protected $appends = [];

    protected $searchables = ['created_at', 'updated_at'];
}
