<?php

namespace Role\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Role\Support\Traits\BelongsToManyUsers;

class Role extends Model
{
    use SoftDeletes, BelongsToManyUsers;

    protected $searchables = ['name', 'code', 'description', 'created_at', 'updated_at'];
}
