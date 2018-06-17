<?php

namespace Course\Models;

use Course\Support\Relations\HasManyLessons;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;

class Course extends Model
{
    use HasManyLessons,
        SoftDeletes;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
