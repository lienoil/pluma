<?php

namespace Role\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Role\Support\Traits\BelongsToManyPermissions;
use Role\Support\Traits\BelongsToManyRoles;

class Grant extends Model
{
    use SoftDeletes, BelongsToManyRoles, BelongsToManyPermissions;

    protected $with = ['permissions'];
}
