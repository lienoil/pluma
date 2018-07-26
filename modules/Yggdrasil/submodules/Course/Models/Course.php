<?php

namespace Course\Models;

use Course\Support\Relations\HasManyLessons;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\SlugOrFail;

class Course extends Model
{
    use HasManyLessons,
        SoftDeletes,
        SlugOrFail;

    protected $searchables = [
        'title',
        'slug',
        'code',
        'feature',
        'backdrop',
        'body',
        'created_at',
        'updated_at'
    ];
}
