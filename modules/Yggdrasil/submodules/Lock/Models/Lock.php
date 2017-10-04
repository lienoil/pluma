<?php

namespace Lock\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Lock\Support\Traits\Unlock;
use Pluma\Models\Model;

class Lock extends Model
{
    use Unlock;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
