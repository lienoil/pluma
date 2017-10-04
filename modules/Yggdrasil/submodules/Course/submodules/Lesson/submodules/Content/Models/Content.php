<?php

namespace Content\Models;

use Lesson\Support\Traits\BelongsToLesson;
use Library\Support\Traits\BelongsToLibrary;
use Lock\Support\Traits\MorphManyUnlocks;
use Lock\Support\Traits\Unlock;
use Pluma\Models\Model;

class Content extends Model
{
    use BelongsToLesson, BelongsToLibrary, Unlock, MorphManyUnlocks;

    protected $with = ['library', 'lesson'];

    protected $append = ['completed'];

    protected $searchables = ['created_at', 'updated_at'];

    public function getCompletedAttribute()
    {
        return 'true';
    }

    public function getCurrentAttribute()
    {
        return 2;
    }
}
