<?php

namespace Assignment\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;

class Assignment extends Model
{
    use SoftDeletes;

    protected $with = [];

    protected $searchables = ['title', 'code', 'description', 'created_at', 'updated_at'];
}
