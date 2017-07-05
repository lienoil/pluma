<?php

namespace Role\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;

class Role extends Model
{
    use SoftDeletes, BelongsToManyUsers;
}
