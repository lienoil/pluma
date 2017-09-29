<?php

namespace Content\Models;

use Lesson\Support\Traits\BelongsToLesson;
use Library\Support\Traits\BelongsToLibrary;
use Pluma\Models\Model;

class Content extends Model
{
    use BelongsToLesson, BelongsToLibrary;

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
