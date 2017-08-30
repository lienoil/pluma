<?php

namespace Course\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;

class Course extends Model
{
    use SoftDeletes;

    protected $with = [];

    protected $searchables = ['title', 'code', 'slug', 'body', 'created_at', 'updated_at'];
}
