<?php

namespace Lesson\Models;

use Assignment\Support\Traits\BelongsToAssignment;
use Content\Support\Traits\HasManyContents;
use Course\Support\Traits\BelongsToCourse;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Mutators\LessonMutator;
use Lock\Support\Traits\MorphManyUnlocks;
use Lock\Support\Traits\Unlock;
use Pluma\Models\Model;

class Lesson extends Model
{
    use SoftDeletes, BelongsToCourse, Unlock, HasManyContents, BelongsToAssignment, LessonMutator, MorphManyUnlocks;

    protected $with = ['assignment'];

    protected $appends = ['completed', 'unlocked', 'locked', 'dialog'];

    protected $searchables = ['created_at', 'updated_at'];
}
