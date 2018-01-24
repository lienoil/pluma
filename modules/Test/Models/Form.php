<?php

namespace Form\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;

class Form extends Model
{
    use SoftDeletes;

    protected $table = 'pages';

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
