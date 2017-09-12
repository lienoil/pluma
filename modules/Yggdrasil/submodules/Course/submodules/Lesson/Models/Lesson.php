<?php

namespace Lesson\Models;

use Content\Support\Traits\HasManyContents;
use Course\Support\Traits\BelongsToCourse;
use Pluma\Models\Model;

class Lesson extends Model
{
    use BelongsToCourse, HasManyContents;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
