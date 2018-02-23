<?php

namespace Student\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;

class Student extends Model
{
    use SoftDeletes;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
