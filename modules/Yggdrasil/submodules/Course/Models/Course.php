<?php

namespace Course\Models;

use Category\Support\Traits\BelongsToCategory;
use Course\Support\Mutators\CourseMutator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Traits\HasManyLessons;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Course extends Model
{
    use SoftDeletes, HasManyLessons, BelongsToUser, BelongsToCategory, CourseMutator;

    protected $with = ['lessons', 'user', 'category'];

    protected $appends = ['created', 'excerpt', 'modified'];

    protected $searchables = ['title', 'code', 'slug', 'feature', 'body', 'created_at', 'updated_at'];
}
