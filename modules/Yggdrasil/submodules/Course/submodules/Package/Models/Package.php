<?php

namespace Package\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Library\Models\Library;

class Package extends Library
{
    use SoftDeletes;

    protected $table = 'library';

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
