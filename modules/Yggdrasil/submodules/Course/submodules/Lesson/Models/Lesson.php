<?php

namespace Lesson\Models;

use Assignment\Support\Traits\BelongsToAssignment;
use Content\Support\Traits\HasManyContents;
use Course\Support\Traits\BelongsToCourse;
use Lesson\Support\Mutators\LessonMutator;
use Lock\Support\Traits\MorphManyUnlocks;
use Lock\Support\Traits\Unlock as Unlockable;
use Pluma\Models\Model;

class Lesson extends Model
{
    use BelongsToCourse, Unlockable, HasManyContents, BelongsToAssignment, LessonMutator, MorphManyUnlocks;

    protected $with = ['assignment', 'unlocks'];

    protected $searchables = ['created_at', 'updated_at'];
}
