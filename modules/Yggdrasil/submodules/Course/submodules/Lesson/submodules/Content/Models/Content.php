<?php

namespace Content\Models;

use Lesson\Support\Traits\BelongsToLesson;
use Library\Support\Traits\HasOneLibrary;
use Pluma\Models\Model;

class Content extends Model
{
    use BelongsToLesson, HasOneLibrary;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
