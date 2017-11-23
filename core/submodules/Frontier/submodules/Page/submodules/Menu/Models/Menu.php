<?php

namespace Menu\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;

class Menu extends Model
{
    use SoftDeletes;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
