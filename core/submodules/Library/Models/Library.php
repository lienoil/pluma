<?php

namespace Library\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;

class Library extends Model
{
    use SoftDeletes;

    protected $table = 'library';

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
