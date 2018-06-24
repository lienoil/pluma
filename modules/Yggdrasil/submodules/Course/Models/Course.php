<?php

namespace Course\Models;

use Course\Support\Relations\HasManyLessons;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;

class Course extends Model
{
    use HasManyLessons,
        SoftDeletes;

    protected $searchables = [
        'title',
        'code',
        'body',
        'created_at',
        'updated_at'
    ];
}
