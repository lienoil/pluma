<?php

namespace Course\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Traits\HasManyLessons;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Course extends Model
{
    use SoftDeletes, HasManyLessons, BelongsToUser;

    protected $with = ['lessons', 'user'];

    protected $searchables = ['title', 'code', 'slug', 'feature', 'body', 'created_at', 'updated_at'];
}
