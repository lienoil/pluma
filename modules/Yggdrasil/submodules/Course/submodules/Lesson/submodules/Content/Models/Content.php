<?php

namespace Content\Models;

use Content\Support\Traits\ContentMutator;
use Lesson\Support\Traits\BelongsToLesson;
use Library\Support\Traits\BelongsToLibrary;
use Lock\Support\Traits\MorphManyUnlocks;
use Lock\Support\Traits\Unlock;
use Pluma\Models\Model;

class Content extends Model
{
    use BelongsToLesson, BelongsToLibrary, Unlock, MorphManyUnlocks, ContentMutator;

    protected $with = ['library', 'lesson', 'unlocks'];

    protected $appends = ['url', 'completed', 'locked', 'unlocked', 'current'];

    protected $searchables = ['title', 'body', 'created_at', 'updated_at'];
}